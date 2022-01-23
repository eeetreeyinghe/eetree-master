<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocDraftRequest;
use App\Http\Resources\DocDraftResource;
use App\Models\Doc;
use App\Models\DocDraft;
use App\Models\DocPublish;
use App\Models\Tag;
use App\Models\UserCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocDraftController extends ApiController
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        $type = $request->input('type');
        if ($type === 'share') {
            $docDrafts = DocDraft::where([
                ['user_id', $userId],
                ['share_id', '<>', ''],
                ['type', Doc::TYPE_DOC],
            ])->orderBy('shared_at', 'desc')->paginate(config('eetree.limit'));
        } else {
            abort(404);
        }

        return $this->success(DocDraftResource::collection($docDrafts));
    }

    public function cv()
    {
        $userId = Auth::id();

        $docDraft = DocDraft::where([
            ['user_id', $userId],
            ['type', Doc::TYPE_CV],
        ])->first();
        if (empty($docDraft)) {
            $docDraft = $this->newDoc(array(
                'title' => '我的简历',
                'tags' => [],
                'content' => '',
                'user_category_id' => 0,
                'last_edit_at' => Carbon::now(),
            ), Doc::TYPE_CV);
        }
        if ($docDraft->doc_id !== 0) {
            $doc = Doc::find($docDraft->doc_id);
        }
        $viewData = [
            'docDraft' => $docDraft->toArray(),
            'docDesc' => empty($doc) ? '' : $doc->description,
            'isPublish' => !empty($doc) && $doc->publish_at ? true : false,
        ];
        if ($docDraft->publish_id) {
            $docPublish = DocPublish::find($docDraft->publish_id);
            if ($docPublish->status === DocPublish::STATUS_REFUSE) {
                $viewData['reviewReason'] = $docPublish->review_remarks;
            }
        }
        return view('doc_draft/edit', $viewData);
    }

    public function edit(DocDraft $docDraft)
    {
        $this->_checkDoc($docDraft);
        if ($docDraft->doc_id !== 0) {
            $doc = Doc::find($docDraft->doc_id);
        }
        return view('doc_draft/edit', [
            'docDraft' => $docDraft->toArray(),
            'docDesc' => empty($doc) ? '' : $doc->description,
            'isPublish' => !empty($doc) && $doc->publish_at ? true : false,
        ]);
    }

    public function preview(DocDraft $docDraft)
    {
        return view('doc/preview', [
            'doc' => $docDraft,
        ]);
    }

    public function share(DocDraft $docDraft)
    {
        if ($docDraft->share_id === '') {
            abort(404);
        }
        return view('doc/preview', [
            'doc' => $docDraft,
        ]);
    }

    public function store(DocDraftRequest $request)
    {
        $data = $request->validated();
        $parentId = (int) $request->input('user_category_id');
        $tplId = (int) $request->input('tpl_id');
        $content = '';
        if ($tplId) {
            $tplDoc = Doc::where('id', $tplId)->first();
            if ($tplDoc) {
                $content = $tplDoc->content;
            }
        }
        $docDraft = $this->newDoc(array(
            'title' => $data['title'],
            'tags' => isset($data['tags']) ? $data['tags'] : [],
            'content' => $content,
            'user_category_id' => $parentId,
            'last_edit_at' => Carbon::now(),
        ));

        return $this->success([
            'url' => route('docDraft.edit', ['docDraft' => $docDraft->id]),
        ]);
    }

    public function duplicate(DocDraft $docDraft)
    {
        $this->_checkDoc($docDraft);
        $copiedDoc = $this->newDoc(array(
            'title' => $docDraft->title . '-副本',
            'tags' => $docDraft->tags->pluck('id')->toArray(),
            'content' => $docDraft->content,
            'user_category_id' => $docDraft->user_category_id,
            'last_edit_at' => $docDraft->last_edit_at,
        ));

        return $this->success(new DocDraftResource($copiedDoc));
    }

    public function copy(Doc $doc, Request $request)
    {
        $parentId = (int) $request->input('user_category_id');
        // $content = json_decode($request->input('content'), true);
        // $content = Doc::clean($content);
        $node = $request->input('node');
        $content = $doc->findNode($node);
        if (empty($content)) {
            return $this->failed('error');
        }
        if (!isset($content['root'])) {
            $content = array('root' => $content);
        }
        if (!isset($content['root']['data']['text'])) {
            return $this->failed('error');
        }
        $copiedDoc = $this->newDoc(array(
            'title' => strip_tags($content['root']['data']['text']),
            'tags' => $doc->tags->pluck('id')->toArray(),
            'content' => $content,
            'user_category_id' => $parentId,
            'last_edit_at' => Carbon::now(),
        ));

        return $this->success(array(
            'url' => route('docDraft.edit', ['docDraft' => $copiedDoc->id]),
        ));
    }

    private function newDoc($data, $type = Doc::TYPE_DOC)
    {
        $userId = Auth::id();
        if ($type === Doc::TYPE_DOC) {
            $cCount = UserCategory::where([
                ['user_id', $userId],
                ['parent_id', $data['user_category_id']],
            ])->count();
            $dCount = DocDraft::where([
                ['user_id', $userId],
                ['user_category_id', $data['user_category_id']],
            ])->count();
            if ($cCount + $dCount >= config('eetree.usercategory.max')) {
                return $this->failed('当前文件夹已满，无法创建');
            }
        }

        $tagIds = $this->_tagIds($data['tags']);
        unset($data['tags']);
        $docDraft = \DB::transaction(function () use ($userId, $data, $tagIds, $type) {
            $docDraft = new DocDraft;
            $docDraft->user_id = $userId;
            $docDraft->doc_id = 0;
            $docDraft->title = $data['title'];
            $docDraft->content = $data['content'];
            $docDraft->last_edit_at = $data['last_edit_at'];
            $docDraft->type = $type;
            $docDraft->user_category_id = $data['user_category_id'];

            $docDraft->save();
            $docDraft->tags()->sync($tagIds);
            return $docDraft;
        });
        return $docDraft;
    }

    private function _tagIds($tags)
    {
        $tagIds = [];
        foreach ($tags as $tag) {
            if (is_int($tag)) {
                $tagIds[] = $tag;
            } else {
                $exist = Tag::where('name', $tag)->first();
                if ($exist) {
                    $tagIds[] = $exist->id;
                } else {
                    $tag = Tag::create([
                        'name' => $tag,
                    ]);
                    $tagIds[] = $tag->id;
                }
            }
        }
        return $tagIds;
    }

    public function save(DocDraft $docDraft, DocDraftRequest $request)
    {
        $this->_checkDoc($docDraft);
        $data = $request->validated();
        if (!empty($data['title'])) {
            $tagIds = $this->_tagIds($data['tags']);
            unset($data['tags']);
            $docDraft->update($data);
            $docDraft->tags()->sync($tagIds);
        } else {
            $content = json_decode($request->input('content'), true);
            $content = Doc::clean($content);
            if (!isset($content['root']['data']['text'])) {
                return $this->failed('error');
            }
            $docDraft->content = $content;
            $docDraft->last_edit_at = Carbon::now();
            $docDraft->save();
        }
        return $this->success([
            'title' => $docDraft->title,
        ]);
    }

    public function move(DocDraft $docDraft, Request $request)
    {
        $userId = Auth::id();
        $this->_checkDoc($docDraft);
        $destId = (int) $request->input('dest');
        if ($docDraft->user_category_id === $destId) {
            return $this->failed('参数有误');
        }
        if ($destId !== 0) {
            $destCategory = UserCategory::find($destId);
            if ($destCategory->user_id !== $userId) {
                return $this->failed('参数有误');
            }
        }
        $docDraft->user_category_id = $destId;
        $docDraft->save();

        return $this->success();
    }

    public function setShare(DocDraft $docDraft)
    {
        $this->_checkDoc($docDraft);
        $docDraft->setShare();

        return $this->success();
    }

    public function publish(DocDraft $docDraft, Request $request)
    {
        $rules = [
            'description' => 'required|min:10|max:100',
        ];
        if ($docDraft->doc_id > 0) {
            $rules['edit_history'] = 'required|min:10|max:100';
        }
        $validatedData = $request->validate($rules);
        $this->_checkDoc($docDraft);
        $validatedData['tags'] = $docDraft->tags->pluck('id')->toArray();
        $docDraft->setPublish($validatedData);

        return $this->success();
    }

    public function delete(DocDraft $docDraft)
    {
        $this->_checkDoc($docDraft);
        $docDraft->delete();

        return $this->success();
    }

    private function _checkDoc($docDraft)
    {
        $userId = Auth::id();
        if ($docDraft->user_id != $userId) {
            abort(403);
        }
    }
}
