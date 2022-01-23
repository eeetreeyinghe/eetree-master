<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\DocRequest;
use App\Http\Requests\Api\DocTopRequest;
use App\Http\Resources\Api\DocResource;
use App\Models\Category;
use App\Models\Doc;
use App\Models\DocCategory;
use App\Models\DocTop;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class DocController extends Controller
{
    //返回文档列表
    public function index(Request $request)
    {
        $sType = $request->input('sType');
        $title = $request->input('title');
        $publish = $request->input('publish', null);
        $where = [];
        if ($sType === 'top') {
            $where[] = ['doc_top.is_top', 1];
        }
        if ($title) {
            $where[] = ['title', 'like', '%' . $title . '%'];
        }
        if ($publish) {
            $where[] = ['publish_at', '<>', null];
        }
        $docs = Doc::with(['user'])
            ->leftJoin('doc_top', 'doc.id', '=', 'doc_top.top_id')
            ->select('doc.*', 'threshold as dt_threshold', 'doc_top.view_count as dt_view_count', 'doc_top.click_count as dt_click_count', 'start_at as dt_start_at', 'end_at as dt_end_at', 'is_top as dt_is_top', 'page_index as dt_page_index', 'page_category as dt_page_category')
            ->orderBy('doc.created_at', 'desc')
            ->orderBy('doc.id')
            ->where($where)
            ->paginate(config('eetree.adminLimit'));
        return $this->success(DocResource::collection($docs));
    }

    private function publish($doc)
    {
        if ($doc->publish_at) {
            return $this->failed('失败，已是上线状态');
        }
        $doc->publish_at = Carbon::now();
        $doc->save();
        return $this->success();
    }

    private function unpublish($doc)
    {
        if (!$doc->publish_at) {
            return $this->failed('失败，已是下线状态');
        }
        $doc->publish_at = null;
        $doc->save();
        return $this->success();
    }

    public function update(Doc $doc, DocRequest $request)
    {
        $publish = (int) $request->input('publish');
        if ($publish === 1) {
            return $this->publish($doc);
        } elseif ($publish === 0) {
            return $this->unpublish($doc);
        }
        $doc->update($request->validated());
        return $this->success();
    }

    public function top(Doc $doc, DocTopRequest $request)
    {
        $data = $request->validated();
        $docTop = DocTop::where('top_id', $doc->id)->first();
        if ($docTop) {
            $docTop->fill([
                'threshold' => $data['threshold'],
                'start_at' => $data['date'][0],
                'end_at' => $data['date'][1],
                'is_top' => 1,
                'page_index' => $data['page_index'],
                'page_category' => $data['page_category'],
                'toped_at' => Carbon::now(),
            ]);
            $docTop->save();
        } else {
            DocTop::create([
                'top_id' => $doc->id,
                'threshold' => $data['threshold'],
                'start_at' => $data['date'][0],
                'end_at' => $data['date'][1],
                'is_top' => 1,
                'page_index' => $data['page_index'],
                'page_category' => $data['page_category'],
                'toped_at' => Carbon::now(),
            ]);
        }
        return $this->success();
    }

    public function untop(Doc $doc)
    {
        DocTop::where('top_id', $doc->id)->update(['is_top' => 0]);
        return $this->success();
    }

    public function move(DocRequest $request)
    {
        $src = (int) $request->input('src');
        $dest = (int) $request->input('dest');
        $destCategory = Category::find($dest);
        if ($src === $dest || empty($destCategory)) {
            return $this->failed('参数有误');
        }
        if ($src === 0) {
            $select = Doc::doesntHave('docCategory')->selectRaw('id as doc_id,' . $destCategory->id . ' as category_id');
            DocCategory::insertUsing(['doc_id', 'category_id'], $select);
        } else {
            DB::transaction(function () use ($src, $dest) {
                $select = DB::query()->fromSub(
                    DocCategory::where(['category_id' => $src])->whereExists(function ($query) use ($dest) {
                        $query->select('*')
                            ->from('doc_category as b')
                            ->where('category_id', $dest)
                            ->whereRaw('doc_category.doc_id = b.doc_id');
                    })->select('id'), 'a'
                )->select('id');
                DocCategory::whereIn('id', $select)->delete();
                DocCategory::where('category_id', $src)->update(['category_id' => $dest]);
            });
        }
        return $this->success();
    }

    public function previewKey(Doc $doc)
    {
        \Illuminate\Support\Facades\Cache::put('Doc:Preview:' . $doc->id, 1, 60);
        return $this->success(['url' => route('doc.preview', ['doc' => $doc->id])]);
    }
}
