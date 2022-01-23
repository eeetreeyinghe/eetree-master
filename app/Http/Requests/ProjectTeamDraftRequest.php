<?php

namespace App\Http\Requests;

class ProjectTeamDraftRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
                return [
                    'id' => ['required'],
                ];
            case 'POST':
                if ($this->user_id) {
                    return [
                        'user_id' => ['required', 'numeric'],
                    ];
                } else {
                    return [
                        'name' => ['required', 'max:100'],
                        'cloud_id' => ['required', 'numeric', 'min:1'],
                        'description' => ['required'],
                    ];
                }
            case 'PUT':
                if ($this->user_id) {
                    return [
                        'user_id' => ['required', 'numeric'],
                    ];
                } else {
                    return [
                        'name' => ['required', 'max:100'],
                        'cloud_id' => ['required', 'numeric', 'min:1'],
                        'description' => ['required'],
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
            'name.required' => '姓名不能为空',
            'name.max' => '姓名不能超过100个字',
            'cloud_id.required' => '头像上传有误',
            'cloud_id.numeric' => '头像上传有误',
            'cloud_id.min' => '头像上传有误',
            'description.required' => '描述不能为空',
        ];
    }
}
