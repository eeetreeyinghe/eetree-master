<?php

namespace App\Http\Requests;

use App\Helpers\Enums;

class ProjectCloudDraftRequest extends FormRequest
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
                    'cloud_id' => ['required', 'numeric'],
                    'type' => ['required', 'in:' . implode(',', Enums::keys('project.cloudTypes'))],
                    'description' => ['max:2000'],
                ];
            case 'PUT':
            case 'PATCH':
            case 'DELETE':
            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'cloud_id.required' => '图片上传有误',
            'cloud_id.numeric' => '图片上传有误',
            'type.in' => '存储类型有误',
            'description.max' => '描述不能超过2000字',
        ];
    }
}
