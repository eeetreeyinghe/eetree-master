<?php

namespace App\Http\Requests;

class ProjectCourseDraftRequest extends FormRequest
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
                    'title' => ['required', 'max:100'],
                    'cloud_id' => ['required', 'numeric'],
                    'link' => 'nullable|url',
                    'description' => ['required', 'max:2000'],
                ];
            case 'PUT':
                return [
                    'title' => ['required', 'max:100'],
                    'cloud_id' => ['required', 'numeric'],
                    'link' => 'nullable|url',
                    'description' => ['required', 'max:2000'],
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
            'title.required' => '标题不能为空',
            'title.max' => '标题不能超过100字',
            'link.url' => '链接格式不正确',
            'cloud_id.required' => '图片上传有误',
            'cloud_id.numeric' => '图片上传有误',
            'description.required' => '描述不能为空',
            'description.max' => '描述不能超过2000字',
        ];
    }
}
