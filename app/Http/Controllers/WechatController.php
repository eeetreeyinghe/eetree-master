<?php

namespace App\Http\Controllers;

use App\Helpers\Enums;
use Illuminate\Http\Request;

class WechatController extends Controller
{
    public function oauthCallback(Request $request)
    {
        $officialAccount = \EasyWeChat::officialAccount();
        $oauth = $officialAccount->oauth;

        // 获取 OAuth 授权结果用户信息
        $wxUser = $oauth->user()->toArray();
        $request->session()->put(Enums::get('sessKey.wxUser'), $wxUser);

        $targetUrl = $request->session()->get(Enums::get('sessKey.wxBackUrl'));
        if (empty($targetUrl)) {
            $targetUrl = '/';
        }

        return redirect($targetUrl);
    }
}
