<?php

namespace App\Http\Requests;

class GoodsTrialDraftRequest extends FormRequest
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
                    'order_id' => ['required', 'numeric'],
                    'title' => ['required', 'max:100'],
                    'description' => ['required'],
                    'cloud_id' => ['required', 'numeric'],
                    'attachment_id' => ['required', 'numeric'],
                ];
            case 'PUT':
                return [
                    'title' => ['required', 'max:100'],
                    'description' => ['required'],
                    'cloud_id' => ['required', 'numeric'],
                    'attachment_id' => ['required', 'numeric'],
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
            'order_id.required' => '参数有误',
            'order_id.numeric' => '参数有误',
            'title.required' => '标题不能为空',
            'title.max' => '标题不能超过100个字',
            'description.required' => '描述不能为空',
            'cloud_id.required' => '图片上传有误',
            'cloud_id.numeric' => '图片上传有误',
            'attachment_id.required' => '附件上传有误',
            'attachment_id.numeric' => '附件上传有误',
        ];
    }
}
