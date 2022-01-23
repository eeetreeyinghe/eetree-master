<?php

namespace App\Http\Requests;

class UserRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
                return [
                    'id' => ['required'],
                ];
            case 'POST':
                return [
                ];
            case 'PUT':
                return [
                    'alipay_account' => ['max:200'],
                    'intro' => ['max:200'],
                ];
            case 'PATCH':
            case 'DELETE':
            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'alipay_account.max' => '支付宝账号太长，请联系管理员',
            'intro.max' => '简介不能超过200个字',
        ];
    }
}
