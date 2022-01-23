<?php

namespace App\Http\Requests\Api;

class RecommendRequest extends FormRequest
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
                    'obj_type' => ['required'],
                    'obj_id' => ['required'],
                    'title' => ['required'],
                    'area_id' => ['required', 'numeric'],
                    'link' => 'nullable|url',
                    'cloud_id' => ['required', 'numeric'],
                    'description' => 'nullable|max:2000',
                    'order' => ['required', 'numeric'],
                ];
            case 'PUT':
                if ($this->move_id) {
                    return [
                        'move_id' => ['integer'],
                    ];
                } else {
                    return [
                        'obj_type' => ['required'],
                        'obj_id' => ['required'],
                        'title' => ['required'],
                        'area_id' => ['required', 'numeric'],
                        'link' => 'nullable|url',
                        'cloud_id' => ['required', 'numeric'],
                        'description' => 'nullable|max:2000',
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
            'title.required' => '标题不能为空',
            'area_id.required' => '请选择分组',
            'area_id.numeric' => '请选择分组',
            'link.url' => '链接格式不正确',
            'cloud_id.required' => '图片上传有误',
            'cloud_id.numeric' => '图片上传有误',
        ];
    }
}
