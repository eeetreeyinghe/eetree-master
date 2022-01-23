<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orderNo = $request->input('orderNo');
        $status = $request->input('status');
        $where = [];
        if ($orderNo) {
            $where[] = ['order_no', $orderNo];
        }
        if ($status !== 'all') {
            $status = (int) $status;
            $where[] = ['status', $status];
        }
        $orders = Order::withTrashed()->with(['user', 'paylog', 'orderItems.projectGoods:id,name,project_id', 'orderItems.projectGoods.project:id,title'])
            ->orderBy('order.created_at', 'desc')
            ->orderBy('order.id')
            ->where($where)
            ->paginate(config('eetree.adminLimit'));
        return $this->success(OrderResource::collection($orders));
    }
}
