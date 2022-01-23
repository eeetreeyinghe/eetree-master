<?php

namespace App\Http\Controllers;

use App\Helpers\Enums;
use App\Helpers\OrderHelper;
use App\Helpers\WechatHelper;
use App\Models\Order;
use App\Models\ProjectGoods;
use Endroid\QrCode\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PayController extends ApiController
{
    private $orderBody = '电子森林-项目众筹';

    private function checkOrder($order, $abort = true)
    {
        if ($order->user_id != Auth::id()) {
            abort(403);
        }
        if ($abort && $order->status != Enums::key('order.status.SUBMIT')) {
            abort(403);
        }
        if ($order->status != Enums::key('order.status.SUBMIT') && $order->created_at->diffInHours() >= config('eetree.order.expires')) {
            $order->status = Enums::key('order.status.OTHER');
            $order->save();
        }
    }

    public function confirm(Request $request)
    {
        $goodsId = (int) $request->input('goods_id');
        $quantity = 1;
        $goods = ProjectGoods::find($goodsId);
        if (empty($goods) || $quantity < 1 || $goods->price <= 0) {
            abort(404);
        }

        $agent = new \Jenssegers\Agent\Agent();
        $viewModel = [
            'goods' => $goods,
            'promote_user' => (int) $request->input('promote'),
            'isWeixin' => WechatHelper::isWeixin(),
            'isMobile' => $agent->isMobile(),
        ];
        if ($viewModel['isWeixin']) {
            $wxUser = WechatHelper::user();
            if (!$wxUser) {
                $request->session()->put(Enums::get('sessKey.wxBackUrl'), route('pay.confirm', ['goods_id' => $goodsId]));
                $officialAccount = \EasyWeChat::officialAccount();
                return $officialAccount->oauth->scopes(['snsapi_base'])->redirect();
            }
        }
        return view('pay/confirm', $viewModel);
    }

    public function index(Request $request)
    {
        $orderId = (int) $request->input('oid');
        if ($orderId) {
            $order = Order::find($orderId);
            if (!$order) {
                return $this->failed('出错了');
            }
        } else {
            $goodsId = (int) $request->input('goods_id');
            $addressId = (int) $request->input('address_id');
            $promoteUserId = (int) $request->input('promote');
            if (!$addressId) {
                return $this->failed('请选择收货地址');
            }
            if (!\App\Models\GoodsPromote::checkPromote($promoteUserId, $goodsId)) {
                $promoteUserId = 0;
            }
            $quantity = 1;
            $goods = ProjectGoods::find($goodsId);
            if (empty($goods) || $quantity < 1 || $goods->price <= 0) {
                return $this->failed('出错了');
            }
            $order = OrderHelper::createByProjectGoods($goods, $quantity, $addressId, $promoteUserId);
            if (!$order) {
                return $this->failed('出错了');
            }
        }
        if (WechatHelper::isWeixin()) {
            return $this->jsapi($order);
        }

        $agent = new \Jenssegers\Agent\Agent();
        $url = $agent->isMobile() ? route('pay.mweb', ['order' => $order]) : route('pay.native', ['order' => $order]);
        return $this->success(['payurl' => $url]);
    }

    private function getWxOrderNo($orderNo, $price, $body, $tradeType)
    {
        return $orderNo . '_' . substr(md5($price . $body . $tradeType), 0, 2);
    }

    private function unify($payment, $order, $tradeType, $openid = '')
    {
        $body = $this->orderBody;
        // if (strlen($body) > 127) {
        //     $body = mb_substr($body, 0, 30) . '...';
        // }
        $params = [
            'body' => $body,
            'out_trade_no' => $this->getWxOrderNo($order->order_no, $order->total_fee, $body, $tradeType),
            'total_fee' => $order->total_fee * 100,
            'notify_url' => route('pay.notify'),
            'trade_type' => $tradeType,
            'time_expire' => date('YmdHis', strtotime('+3 minute')),
        ];
        if ($tradeType === 'JSAPI') {
            $params['openid'] = $openid;
        }
        $result = $payment->order->unify($params);
        if (array_key_exists('return_code', $result)
            && array_key_exists('result_code', $result)
            && $result['return_code'] == "SUCCESS"
            && $result['result_code'] == "SUCCESS") {
            return $result;
        } else {
            Log::error('pay-weixin - ' . json_encode($result));
            abort(500);
        }
    }

    public function native(Order $order)
    {
        $this->checkOrder($order);
        $payment = \EasyWeChat::payment();
        $result = $this->unify($payment, $order, 'NATIVE');

        return view('pay/native', [
            'payUrl' => route('pay.qrcode', ['wx' => $result['code_url']]),
            'order' => $order,
        ]);
    }

    public function mweb(Order $order)
    {
        $this->checkOrder($order);
        $payment = \EasyWeChat::payment();
        $returnUrl = route('pay.returnto', ['order' => $order]);
        $result = $this->unify($payment, $order, 'MWEB');
        if ($result['return_code'] === 'SUCCESS' && isset($result['mweb_url'])) {
            return redirect($result['mweb_url'] . '&redirect_url=' . urlencode($returnUrl));
        } else {
            Log::error('pay-weixin-mweb - ' . json_encode($result));
            abort(500);
        }
    }

    private function jsapi($order)
    {
        $wxUser = WechatHelper::user();
        if (!$wxUser) {
            return $this->fail('出错了，请确保在微信中打开');
        }
        $payment = \EasyWeChat::payment();
        $result = $this->unify($payment, $order, 'JSAPI', $wxUser['id']);
        return $this->success($payment->jssdk->bridgeConfig($result['prepay_id'], false));
    }

    public function checkPaid(Order $order, Request $request)
    {
        $this->checkOrder($order, false);
        if ($order->status != Enums::key('order.status.PAID') && $request->input('nno') == 'notify') {
            $tradeTypes = ['NATIVE', 'MWEB', 'JSAPI'];
            for ($i = 0; $i < $tradeTypes; $i++) {
                $tradeType = $tradeTypes[$i];
                $res = OrderHelper::notify([
                    'out_trade_no' => $this->getWxOrderNo($order->order_no, $order->total_fee, $this->orderBody, $tradeType),
                    'check_paid' => true,
                ], $order);
                if ($res !== 'fail') {
                    break;
                }
            }
        }
        return $this->success($order->status == Enums::key('order.status.PAID'));
    }

    public function pSuccess(Request $request)
    {
        $agent = new \Jenssegers\Agent\Agent();
        $projectId = (int) $request->input('pid', 0);
        if ($agent->isMobile()) {
            $redirectUrl = $projectId ? route('project.detail', ['project' => $projectId]) : route('explore.project');
        } else {
            $redirectUrl = route('user.center') . config('eetree.ucenter.order');
        }
        return view('pay/success', [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function returnto(Order $order, Request $request)
    {
        $this->checkOrder($order);
        if ($order->status == Enums::key('order.status.PAID')) {
            return view('pay/success');
        }
        $projectId = $order->orderItems->first()->projectGoods->project_id;
        $redirectUrl = $projectId ? route('project.detail', ['project' => $projectId]) : route('explore.project');
        return view('pay/wait', [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function notify()
    {
        $payment = \EasyWeChat::payment();
        return $payment->handlePaidNotify(function ($message, $fail) use ($payment) {

            $orderNo = substr($message['out_trade_no'], 0, -3);
            $order = Order::withTrashed()->where('order_no', $orderNo)->first();

            if (!$order) { // 如果订单不存在
                return true;
            }

            if ($message['return_code'] === 'SUCCESS') { // return_code 表示通信状态，不代表支付状态
                $notified = OrderHelper::notify($message, $order, $payment);
                if ($notified === 'fail') {
                    return $fail('订单获取失败，请稍后再通知我');
                }
            } else {
                return $fail('通信失败，请稍后再通知我');
            }

            return true; // 返回处理完成
        });
    }

    public function qrcode(Request $request)
    {
        $url = $request->input('wx');
        if (preg_match('#^weixin://wxpay[a-zA-Z0-9/?=]*$#', $url)) {
            $qrCode = new QrCode($url);

            header('Content-Type: ' . $qrCode->getContentType());
            echo $qrCode->writeString();
            exit;
        }
        exit;
    }
}
