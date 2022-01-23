<?php

namespace App\Http\Requests\Api;

class ProjectTopRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'PUT':
                return [
                    'date' => ['required'],
                    'threshold' => ['required'],
                ];
            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'date.required' => '置顶时间段不能为空',
            'threshold.required' => '点击阀值不能为空',
        ];
    }
}
