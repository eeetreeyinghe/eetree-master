<?php

namespace App\Http\Controllers;

use App\Helpers\Enums;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group order
 * 订单
 */
class OrderController extends ApiController
{
    /**
     * my orders
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        $status = $request->input('status', null);
        $where = [[
            'user_id', $userId,
        ]];
        if ($status == 'submit') {
            $where[] = ['status', Enums::key('order.status.SUBMIT')];
        }
        $orders = Order::with(['orderItems.projectGoods' => function ($query) {
            $query->withTrashed()->with(['cloud', 'project:id,title']);
        }])
            ->orderBy('order.created_at', 'desc')
            ->where($where)
            ->paginate(config('eetree.limit'));
        return $this->success(OrderResource::collection($orders));
    }

    public function delete(Order $order)
    {
        if ($order->user_id != Auth::id()) {
            abort(403);
        }
        $order->delete();
        return $this->success();
    }
}
