<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Enums;
use App\Http\Requests\Api\GoodsTrialRequest;
use App\Http\Requests\Api\GoodsTrialReviewRequest;
use App\Http\Resources\Api\GoodsTrialResource;
use App\Models\GoodsTrial;
use App\Models\GoodsTrialDraft;
use App\Models\Notice;
use App\Models\ProjectGoods;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GoodsTrialController extends Controller
{
    public function index(Request $request)
    {
        $draft = $request->input('draft');
        $goodsName = $request->input('goodsName');
        $projectTitle = $request->input('projectTitle');
        $status = (int) $request->input('status');
        $where = [];
        if ($goodsName) {
            $where[] = ['project_goods.Name', 'like', '%' . $goodsName . '%'];
        }
        if ($projectTitle) {
            $where[] = ['project.title', 'like', '%' . $projectTitle . '%'];
        }
        if ($draft) {
            $where[] = ['goods_trial_draft.status', $status];

            $goodsTrials = GoodsTrialDraft::with(['user'])
                ->join('project_goods', 'project_goods.id', '=', 'goods_trial_draft.goods_id')
                ->join('project', 'project.id', '=', 'project_goods.project_id')
                ->select('goods_trial_draft.*', 'project.id as pj_id', 'project.title as pj_title', 'project_goods.name as gd_name')
                ->orderBy('goods_trial_draft.id', 'desc')
                ->whereNotNull('project.last_publish_at')
                ->where($where)
                ->paginate(config('eetree.adminLimit'));
        } else {
            $goodsTrials = GoodsTrial::with(['user'])
                ->join('project_goods', 'project_goods.id', '=', 'goods_trial.goods_id')
                ->join('project', 'project.id', '=', 'project_goods.project_id')
                ->select('goods_trial.*', 'project.id as pj_id', 'project.title as pj_title', 'project_goods.name as gd_name')
                ->orderBy('goods_trial.id', 'desc')
                ->whereNotNull('project.last_publish_at')
                ->where($where)
                ->paginate(config('eetree.adminLimit'));
        }
        return $this->success(GoodsTrialResource::collection($goodsTrials));
    }

    private function publish($trial)
    {
        if ($trial->publish_at) {
            return $this->failed('失败，已是上线状态');
        }
        $trial->publish_at = Carbon::now();
        $trial->save();
        return $this->success();
    }

    private function unpublish($trial)
    {
        if (!$trial->publish_at) {
            return $this->failed('失败，已是下线状态');
        }
        $trial->publish_at = null;
        $trial->save();
        return $this->success();
    }

    public function update(GoodsTrial $goodsTrial, GoodsTrialRequest $request)
    {
        $publish = (int) $request->input('publish');
        if ($publish === 1) {
            return $this->publish($goodsTrial);
        } elseif ($publish === 0) {
            return $this->unpublish($goodsTrial);
        }
        $goodsTrial->update($request->validated());
        return $this->success();
    }

    public function review(GoodsTrialDraft $draftTrial, GoodsTrialReviewRequest $request)
    {
        if (!in_array($draftTrial->status, [Enums::key('status.SUBMIT'), Enums::key('status.REFUSE')])) {
            return $this->failed('参数有误');
        }

        \DB::transaction(function () use ($draftTrial, $request) {
            $data = $request->validated();
            $data['status'] = (int) $data['status'];
            if ($data['status'] === Enums::key('status.PASS')) {
                if ($draftTrial->trial_id) {
                    $trial = GoodsTrial::find($draftTrial->trial_id);
                } else {
                    $trial = new GoodsTrial;
                    $trial->user_id = $draftTrial->user_id;
                    $trial->order_id = $draftTrial->order_id;
                    $trial->project_id = $draftTrial->project_id;
                    $trial->goods_id = $draftTrial->goods_id;
                }
                $trial->title = $draftTrial->title;
                $trial->description = $draftTrial->description;
                $trial->cloud_id = $draftTrial->cloud_id;
                $trial->attachment_id = $draftTrial->attachment_id;
                $trial->publish_at = Carbon::now();
                $trial->save();

                if (!$draftTrial->trial_id) {
                    $data['trial_id'] = $trial->id;
                }
                $draftTrial->update($data);

                $projectGoods = ProjectGoods::find($draftTrial->goods_id);
                Notice::create(array(
                    'user_id' => $draftTrial->user_id,
                    'content' => sprintf(config('notices.goods_trial_passed'), $draftTrial->title, route('project.detail', ['project' => $projectGoods->project_id])),
                ));
            } else {
                $draftTrial->update($data);

                Notice::create(array(
                    'user_id' => $draftTrial->user_id,
                    'content' => sprintf(config('notices.goods_trial_refused'), $draftTrial->title, route('user.center') . '#/order/list', $draftTrial->review_remarks),
                ));
            }
        });
        return $this->success();
    }
}
