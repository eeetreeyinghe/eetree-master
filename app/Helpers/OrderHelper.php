<?php

namespace App\Helpers;

use App\Helpers\Enums;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PayLog;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;

class OrderHelper
{
    public static function createByProjectGoods($goods, $quantity, $addressId, $promoteUserId, $retry = 1)
    {
        try {
            $order = DB::transaction(function () use ($goods, $quantity, $addressId, $promoteUserId) {
                $userId = Auth::Id();
                $orderNo = self::generateOrderNo();
                $fee = $goods->price * $quantity;
                $address = Address::find($addressId);
                if (!$address) {
                    return false;
                }
                $order = Order::create([
                    'order_no' => $orderNo,
                    'user_id' => $userId,
                    'price' => $fee,
                    'total_fee' => $fee,
                    'status' => Enums::key('order.status.SUBMIT'), //没有购物车，创建即提交订单
                    'name' => $address->name,
                    'mobile' => $address->mobile,
                    'address' => $address->province . $address->city . $address->district . $address->address,
                    'postcode' => $address->postcode,
                ]);
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'pitem' => $goods->project_id,
                    'item' => $goods->id,
                    'item_name' => $goods->name,
                    'price' => $goods->price,
                    'fee' => $fee,
                    'quantity' => $quantity,
                    'promote_user' => $promoteUserId,
                ]);
                $order->items = [$orderItem];
                return $order;
            });
            return $order;
        } catch (\Illuminate\Database\QueryException $e) {
            if (strpos($e->getMessage(), '1062 Duplicate entry') && $retry > 0) {
                return self::createByProjectGoods($goods, $quantity, $addressId, $promoteUserId, --$retry);
            }
            throw $e;
        }
    }

    public static function generateOrderNo()
    {
        return date('Ymd') . rand(1000, 9999) . substr(microtime(), 2, 4);
    }

    public static function notify($message, $order, $payment = null)
    {
        if (!$payment) {
            $payment = \EasyWeChat::payment();
        }
        $result = $payment->order->queryByOutTradeNumber($message['out_trade_no']);

        if (array_key_exists('return_code', $result)
            && array_key_exists('result_code', $result)
            && $result['return_code'] == "SUCCESS"
            && $result['result_code'] == "SUCCESS") {
            $ret = DB::transaction(function () use ($result, $order) {
                if ($result['trade_state'] === 'SUCCESS') {
                    $orderStatus = Enums::key('order.status.PAID');
                } else {
                    $orderStatus = Enums::key('order.status.OTHER');
                    if (!empty($message['check_paid'])) {
                        return 'fail';
                    }
                }

                // paylog
                $payLog = PayLog::where('out_trade_no', $result['out_trade_no'])->first();
                if (!$payLog) {
                    $payLog = PayLog::create([
                        'order_id' => $order->id,
                        'out_trade_no' => $result['out_trade_no'],
                        'method' => 'wxpay',
                        'sub_method' => isset($result['trade_type']) ? $result['trade_type'] : '',
                        'total_fee' => isset($result['total_fee']) ? $result['total_fee'] / 100 : 0,
                        'status' => $orderStatus,
                        'data' => json_encode($result),
                    ]);
                } elseif ($payLog->status != Enums::key('order.status.PAID')) {
                    $payLog->update([
                        'status' => $orderStatus,
                        'data' => json_encode($result),
                    ]);
                }

                // update order and goods
                if ($order->status != Enums::key('order.status.PAID')) {
                    if ($result['trade_state'] === 'SUCCESS') {
                        $order->paid_at = Carbon::now();
                    }
                    $order->status = $orderStatus;
                    $order->save();
                    \App\Jobs\OrderSuccessJob::dispatch($order);
                }
                return 'success';
            });
            return $ret;
        }
        return 'fail';
    }

    public static function afterOrder($order)
    {
        if ($order->job == 1 || $order->status != Enums::key('order.status.PAID')) {
            return;
        }
        DB::transaction(function () use ($order) {
            $now = Carbon::now();
            $orderCount = Order::withTrashed()
                ->where([
                    'status' => Enums::key('order.status.PAID'),
                    'user_id' => $order->user_id,
                ])->count();
            $order->load('orderItems.projectGoods.project');
            $projectIds = [];
            $updates = [];
            $userRevenue = [];
            $revenueLog = [];
            $platformRatio = config('eetree.revenue.platformRatio');

            foreach ($order->orderItems as $item) {
                $projectId = $item->projectGoods->project_id;
                // project fund_crowd
                $projectIds[] = $projectId;
                if (!isset($updates[$projectId])) {
                    $updates[$projectId] = [
                        'fund_crowd' => 0,
                    ];
                }
                $updates[$projectId]['fund_crowd'] += $item->fee;

                // user revenue
                $userId = $item->projectGoods->project->user_id;
                if (!isset($userRevenue[$userId])) {
                    $userRevenue[$userId] = [
                        'revenue' => 0,
                        'promote_revenue' => 0,
                    ];
                }
                $userRatio = $item->projectGoods->project->user_ratio;
                if (!$userRatio) {
                    $userRatio = config('eetree.revenue.userRatio');
                }
                $revenue = round($item->fee * $userRatio, 2);
                $userRevenue[$userId]['revenue'] += $revenue;
                $revenueLog[] = [
                    'user_id' => $userId,
                    'item_id' => $item->id,
                    'fee' => $item->fee,
                    'revenue' => $revenue,
                    'paid_at' => $order->paid_at,
                    'type' => Enums::key('order.type.NORMAL'),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
                //promote revenue
                if ($item->promote_user > 0) {
                    if (!isset($userRevenue[$item->promote_user])) {
                        $userRevenue[$item->promote_user] = [
                            'revenue' => 0,
                            'promote_revenue' => 0,
                        ];
                    }
                    $promoteRevenue = round($item->fee * $platformRatio, 2);
                    if ($promoteRevenue > 0) {
                        $userRevenue[$item->promote_user]['revenue'] += $promoteRevenue;
                        $userRevenue[$item->promote_user]['promote_revenue'] += $promoteRevenue;
                        $revenueLog[] = [
                            'user_id' => $item->promote_user,
                            'item_id' => $item->id,
                            'fee' => $item->fee,
                            'revenue' => $promoteRevenue,
                            'paid_at' => $order->paid_at,
                            'type' => Enums::key('order.type.PROMOTE'),
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }
                }
            }
            $projectIds = array_unique($projectIds);
            if ($orderCount == 1) {
                // first time
                Project::whereIn('id', $projectIds)->increment('backers');
            }
            foreach ($updates as $projectId => $updRow) {
                Project::where('id', $projectId)->update([
                    'fund_crowd' => DB::raw('`fund_crowd` + ' . $updRow['fund_crowd']),
                ]);
            }
            // owner revenue
            foreach ($userRevenue as $userId => $updRow) {
                $updRevenue = [];
                if ($updRow['revenue'] > 0) {
                    $updRevenue['revenue'] = DB::raw('`revenue` + ' . $updRow['revenue']);
                }
                if ($updRow['promote_revenue'] > 0) {
                    $updRevenue['promote_revenue'] = DB::raw('`promote_revenue` + ' . $updRow['promote_revenue']);
                }
                User::where('id', $userId)->update($updRevenue);
            }
            if (!empty($revenueLog)) {
                \App\Models\RevenueLog::insert($revenueLog);
            }
            $order->update(['job' => 1]);
        });
    }
}
