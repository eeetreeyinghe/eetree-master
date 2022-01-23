<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\GoodsPromoteRequest;
use App\Http\Requests\Api\ProjectGoodsRequest;
use App\Http\Resources\Api\ProjectGoodsResource;
use App\Models\GoodsPromote;
use App\Models\ProjectGoods;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProjectGoodsController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->input('name');
        $projectTitle = $request->input('projectTitle');
        $sType = $request->input('sType');
        $where = [];
        if ($name) {
            $where[] = ['project_goods.name', 'like', '%' . $name . '%'];
        }
        if ($projectTitle) {
            $where[] = ['project.title', 'like', '%' . $projectTitle . '%'];
        }
        if ($sType === 'promote') {
            $where[] = ['goods_promote.id', '>', 0];
        }
        $goods = ProjectGoods::with('xform')
            ->join('project', 'project.id', '=', 'project_goods.project_id')
            ->join('user', 'project.user_id', '=', 'user.id')
            ->leftJoin('goods_promote', 'project_goods.id', 'goods_promote.goods_id')
            ->select('project_goods.*', 'title as pj_title', 'nickname as ur_nickname', 'threshold as dt_threshold', 'goods_promote.view_count as dt_view_count', 'goods_promote.pay_count as dt_pay_count', 'goods_promote.start_at as dt_start_at', 'goods_promote.end_at as dt_end_at')
            ->orderBy('project_goods.id', 'desc')
            ->whereNotNull('project.last_publish_at')
            ->where($where)
            ->paginate(config('eetree.adminLimit'));
        return $this->success(ProjectGoodsResource::collection($goods));
    }

    public function update(ProjectGoods $projectGoods, ProjectGoodsRequest $request)
    {
        $data = $request->validated();
        $projectGoods->update($data);
        return $this->success();
    }

    public function promote(ProjectGoods $projectGoods, GoodsPromoteRequest $request)
    {
        $data = $request->validated();
        $goodsPromote = GoodsPromote::where('goods_id', $projectGoods->id)->first();
        if ($goodsPromote) {
            $goodsPromote->fill([
                'threshold' => $data['threshold'],
                'start_at' => $data['date'][0],
                'end_at' => $data['date'][1],
                'promote_at' => Carbon::now(),
            ]);
            $goodsPromote->save();
        } else {
            GoodsPromote::create([
                'goods_id' => $projectGoods->id,
                'threshold' => $data['threshold'],
                'start_at' => $data['date'][0],
                'end_at' => $data['date'][1],
                'promote_at' => Carbon::now(),
            ]);
        }
        return $this->success();
    }

    public function unpromote(ProjectGoods $projectGoods)
    {
        GoodsPromote::where('goods_id', $projectGoods->id)->delete();
        return $this->success();
    }
}
