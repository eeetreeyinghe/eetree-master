<?php

namespace App\Http\Requests;

class ProjectGoodsDraftRequest extends FormRequest
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
                    'cloud_id' => ['required', 'numeric'],
                    'price' => ['required', 'regex:/^\d{1,8}(\.\d{1,2})?$/'],
                    'link' => 'nullable|url',
                    'description' => ['required'],
                ];
            case 'PUT':
                return [
                    'name' => ['required', 'max:100'],
                    'cloud_id' => ['required', 'numeric'],
                    'price' => ['required', 'regex:/^\d{1,8}(\.\d{1,2})?$/'],
                    'link' => 'nullable|url',
                    'description' => ['required'],
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
            'name.max' => '名称不能超过100个字',
            'cloud_id.required' => '图片上传有误',
            'cloud_id.numeric' => '图片上传有误',
            'price.required' => '价格不能为空',
            'price.regex' => '价格必须在 0 - 99999999.99 之间, 最多两位小数',
            'link.url' => '链接格式不正确',
            'description.required' => '描述不能为空',
        ];
    }
}
