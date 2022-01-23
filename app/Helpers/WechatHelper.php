<?php

namespace App\Helpers;

use Jenssegers\Agent\Agent;

class WechatHelper
{
    public static function user()
    {
        $sessKey = config('enums.sessKey.wxUser');
        $user = session($sessKey);
        return $user;
    }

    public static function isWeixin()
    {
        $agent = new Agent();
        if ($agent->match('MicroMessenger')) {
            return true;
        } else {
            return false;
        }
    }
}
