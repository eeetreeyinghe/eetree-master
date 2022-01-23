<?php

namespace App\Http\Requests;

class ProjectScheduleDraftRequest extends FormRequest
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
                    'video_code' => ['present'],
                    'submit_at' => ['required', 'date'],
                    'description' => ['required'],
                ];
            case 'PUT':
                return [
                    'title' => ['required', 'max:100'],
                    'video_code' => ['present'],
                    'submit_at' => ['required', 'date'],
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
            'title.required' => '标题不能为空',
            'title.max' => '标题不能超过100个字',
            'submit_at.required' => '日期不能为空',
            'submit_at.date' => '日期格式有误',
            'description.required' => '描述不能为空',
        ];
    }
}
