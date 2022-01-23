<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\DocPublishRequest;
use App\Http\Resources\Api\DocPublishResource;
use App\Models\Doc;
use App\Models\DocDraft;
use App\Models\DocHistory;
use App\Models\DocPublish;
use App\Models\Notice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class DocPublishController extends Controller
{
    //返回菜单列表
    public function index(DocPublishRequest $request)
    {
        $docPublishs = DocPublish::with(['user:id,nickname', 'docCategory:doc_id,category_id'])
            ->where('status', $request->input('status'))
            ->orderBy('created_at', 'desc')
            ->paginate(config('eetree.adminLimit'));
        return $this->success(DocPublishResource::collection($docPublishs));
    }

    public function previewKey(DocPublish $docPublish)
    {
        Cache::put('DocPublish:Preview:' . $docPublish->id, 1, 60);
        return $this->success(['url' => route('docPublish.preview', ['docPublish' => $docPublish->id])]);
    }

    public function review(DocPublish $docPublish, DocPublishRequest $request)
    {
        if (!in_array($docPublish->status, [DocPublish::STATUS_SUBMIT, DocPublish::STATUS_REFUSE])) {
            return $this->failed('参数有误');
        }
        \DB::transaction(function () use ($docPublish, $request) {
            $data = $request->validated();
            $docPublish->update($data);
            if ($docPublish->type === Doc::TYPE_CV) {
                $data['category_id'] = null;
            }
            $status = (int) $data['status'];
            if ($status === DocPublish::STATUS_PASS) {
                if ($docPublish->doc_id) {
                    $doc = Doc::find($docPublish->doc_id);
                    if (empty($doc)) {
                        return $this->failed('参数有误');
                    }
                    $doc->fill($docPublish->toArray());
                    $doc->publish_at = Carbon::now();
                    $doc->formatContent();
                    $doc->save();
                    $doc->category()->sync($data['category_id']);
                    DocHistory::create([
                        'doc_id' => $docPublish->doc_id,
                        'description' => $docPublish->edit_history,
                    ]);
                } else {
                    $row = $docPublish->toArray();
                    $doc = new Doc;
                    $doc->fill($row);
                    $doc->user_id = $row['user_id'];
                    $doc->type = $row['type'];
                    $doc->publish_at = Carbon::now();
                    $doc->formatContent();
                    $doc->save();
                    $doc->category()->sync($data['category_id']);
                    $docPublish->update(['doc_id' => $doc->id]);
                    DocDraft::where('publish_id', $docPublish->id)->update(['doc_id' => $doc->id]);
                }
                $doc->tags()->sync($docPublish->tags);
                Notice::create(array(
                    'user_id' => $docPublish->user_id,
                    'content' => sprintf(config('notices.doc_passed'), $docPublish->title, route('doc.detail', ['doc' => $doc->id])),
                ));
            } else {
                $docDraft = DocDraft::where('publish_id', $docPublish->id)->first();
                if ($docDraft) {
                    Notice::create(array(
                        'user_id' => $docPublish->user_id,
                        'content' => sprintf(config('notices.doc_refused'), $docPublish->title, route('docDraft.edit', ['docDraft' => $docDraft->id]), $docPublish->review_remarks),
                    ));
                }
            }
        });
        return $this->success();
    }
}
