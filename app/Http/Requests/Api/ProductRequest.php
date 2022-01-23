<?php

namespace App\Http\Requests\Api;

class ProductRequest extends FormRequest
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
                    'cloud_id' => ['required', 'numeric'],
                    'supplier_id' => ['required'],
                    'type' => ['required'],
                    'description' => 'nullable|max:2000',
                    'link' => 'nullable|url',
                ];
            case 'PUT':
                return [
                    'name' => ['required'],
                    'cloud_id' => ['required', 'numeric'],
                    'supplier_id' => ['required'],
                    'type' => ['required'],
                    'description' => 'nullable|max:2000',
                    'link' => 'nullable|url',
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
            'name.required' => '名称不能为空',
            'cloud_id.required' => '图片上传有误',
            'cloud_id.numeric' => '图片上传有误',
            'supplier_id.required' => '类型不能为空',
            'type.required' => '类型不能为空',
            'link.url' => '链接格式不正确',
            'description.max' => '简介不能超过2000字',
        ];
    }
}
