<?php

namespace App\Http\Controllers;

use App\Helpers\Enums;
use App\Http\Requests\GoodsTrialDraftRequest;
use App\Models\GoodsTrialDraft;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * @group trials
 * 产品试用接口
 */
class GoodsTrialDraftController extends ApiController
{
    /**
     * add trial
     * @bodyParam  order_id int 订单ID
     * @bodyParam  cloud_id int 图片
     * @bodyParam  attachment_id int 附件
     * @bodyParam  title string 标题
     * @bodyParam  description string 描述
     */
    public function store(GoodsTrialDraftRequest $request)
    {
        $data = $request->validated();
        $order = Order::find($data['order_id']);
        if (!$order) {
            return $this->failed('参数有误');
        }
        $orderItem = $order->orderItems->first();
        if (!empty($data['description'])) {
            $data['description'] = clean($data['description']);
        }
        $data['submit_at'] = Carbon::now();
        $data['project_id'] = $orderItem->pitem;
        $data['goods_id'] = $orderItem->item;
        $data['user_id'] = Auth::id();
        $data['status'] = Enums::key('status.SUBMIT');
        $trialDraft = GoodsTrialDraft::create($data);
        return $this->success(['id' => $trialDraft->id]);
    }

    /**
     * update trial
     * @urlParam trialDraft 试用ID
     * @bodyParam  order_id int 订单ID
     * @bodyParam  cloud_id int 图片
     * @bodyParam  attachment_id int 附件
     * @bodyParam  title string 标题
     * @bodyParam  description string 描述
     */
    public function update(GoodsTrialDraft $trialDraft, GoodsTrialDraftRequest $request)
    {
        $trialDraft->checkEdit();
        $data = $request->validated();
        if (!empty($data['description'])) {
            $data['description'] = clean($data['description']);
        }
        $data['submit_at'] = Carbon::now();
        $data['status'] = Enums::key('status.SUBMIT');
        $trialDraft->update($data);
        return $this->success();
    }
}
