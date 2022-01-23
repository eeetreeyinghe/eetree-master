<?php

namespace App\Http\Requests;

class AddressRequest extends FormRequest
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
                    'name' => ['required', 'max:100'],
                    'mobile' => ['required', 'regex:/^1[0-9]{10}$/'],
                    'province' => ['required', 'max:16'],
                    'city' => ['required', 'max:16'],
                    'district' => ['required', 'max:16'],
                    'address' => ['required', 'max:255'],
                    'postcode' => ['nullable', 'integer'],
                    'default' => ['required', 'in:0,1'],
                ];
            case 'PUT':
                return [
                    'name' => ['required', 'max:100'],
                    'mobile' => ['required', 'regex:/^1[0-9]{10}$/'],
                    'province' => ['required', 'max:16'],
                    'city' => ['required', 'max:16'],
                    'district' => ['required', 'max:16'],
                    'address' => ['required', 'max:255'],
                    'postcode' => ['nullable', 'integer'],
                    'default' => ['required', 'in:0,1'],
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
            'name.required' => '姓名不能为空',
            'name.max' => '姓名不能超过100个字',
            'mobile.required' => '手机号不能为空',
            'mobile.regex' => '手机号格式有误',
            'province.required' => '请选择省市区',
            'city.required' => '请选择省市区',
            'district.required' => '请选择省市区',
            'address.required' => '地址不能为空',
            'postcode.integer' => '邮编填写有误',
            'default.required' => '项目参数有误',
            'default.in' => '项目参数有误',
        ];
    }
}
