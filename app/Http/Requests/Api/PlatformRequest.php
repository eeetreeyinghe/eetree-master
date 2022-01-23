<?php

namespace App\Http\Requests\Api;

class PlatformRequest extends FormRequest
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
                    'name' => ['required'],
                    'link' => 'nullable|url',
                    'order' => ['numeric'],
                ];
            case 'PUT':
                if ($this->move_id) {
                    return [
                        'move_id' => ['integer'],
                    ];
                } else {
                    return [
                        'name' => ['required'],
                        'link' => 'nullable|url',
                        'order' => ['numeric'],
                    ];
                }
            case 'PATCH':
            case 'DELETE':
            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'move_id.integer' => '参数有误',
            'name.required' => '名称不能为空',
            'link.url' => '链接格式不正确',
            'order.numeric' => '排序请填写数字',
        ];
    }
}
