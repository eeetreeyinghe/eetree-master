<?php

namespace App\Http\Controllers;

use App\Helpers\SmsHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SmsController extends ApiController
{
    public function code(Request $request)
    {
        $data = $request->all();
        $mobileRule = ['required', 'string', 'regex:/^1[0-9]{10}$/'];
        if ($data['tpl'] === 'register') {
            $mobileRule[] = 'unique:user';
        }
        $rules = [
            'mobile' => $mobileRule,
        ];
        $message = [];

        if (config('eetree.captcha.' . $data['tpl'])) {
            $rules['captcha'] = ['required', 'captcha'];
            $message['captcha.required'] = '请填写图片校验码';
            $message['captcha.captcha'] = '图片校验码错误';
        }

        Validator::make($data, $rules, $message)->validate();
        $code = SmsHelper::code($data['mobile'], $data['tpl']);
        if ($code) {
            return $this->success();
        } else {
            return $this->error('获取手机验证码失败');
        }
    }
}
