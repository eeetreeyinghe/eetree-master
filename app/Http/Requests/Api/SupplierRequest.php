<?php

namespace App\Http\Requests\Api;

class SupplierRequest extends FormRequest
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
                    'cloud_id' => ['required', 'numeric'],
                ];
            case 'PUT':
                return [
                    'name' => ['required'],
                    'link' => 'nullable|url',
                    'cloud_id' => ['required', 'numeric'],
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
            'link.url' => '链接格式不正确',
            'cloud_id.required' => '图片上传有误',
            'cloud_id.numeric' => '图片上传有误',
        ];
    }
}
