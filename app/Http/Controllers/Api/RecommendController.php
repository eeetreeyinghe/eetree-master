<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\RecommendRequest;
use App\Http\Resources\Api\RecommendResource;
use App\Models\Recommend;
use Illuminate\Http\Request;

class RecommendController extends Controller
{
    //返回推荐列表
    public function index(Request $request)
    {
        $title = $request->input('title');
        $area_id = (int) $request->input('area_id');
        $where = [];
        if ($title) {
            $where[] = ['title', 'like', '%' . $title . '%'];
        }
        if ($area_id != -1) {
            $where[] = ['area_id', $area_id];
        }
        $recommends = Recommend::with(['cloud'])->where($where)->orderBy('area_id', 'asc')->orderBy('order', 'asc')->paginate(config('eetree.adminLimit'));
        return $this->success(RecommendResource::collection($recommends));
    }

    //删除推荐
    public function delete(Recommend $recommend)
    {
        Recommend::where([
            ['order', '>', $recommend->order],
            ['area_id', '=', $recommend->area_id],
        ])->decrement('order');
        $recommend->delete();
        return $this->success();
    }

    public function store(RecommendRequest $request)
    {
        $data = $request->validated();
        if ($data['order'] == 0) {
            $data['order'] = 1;
        }
        Recommend::where([
            ['order', '>=', $data['order']],
            ['area_id', '=', $data['area_id']],
        ])->increment('order');
        $recommend = Recommend::create($data);
        return $this->success(new RecommendResource($recommend));
    }

    public function update(Recommend $recommend, RecommendRequest $request)
    {
        $data = $request->validated();
        if (isset($data['move_id'])) {
            $moveRecommend = Recommend::find($data['move_id']);
            if (!$moveRecommend) {
                $this->failed('出错了');
            }
            $changeOrder = $recommend->order;
            $recommend->update(['order' => $moveRecommend->order]);
            $moveRecommend->update(['order' => $changeOrder]);
        } else {
            $recommend->update($data);
        }
        return $this->success(new RecommendResource($recommend));
    }
}
