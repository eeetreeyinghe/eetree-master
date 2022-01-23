<?php

namespace App\Http\Requests\Api;

class ProjectRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
                return [
                    'id' => ['required'],
                ];
            case 'PUT':
                $publish = (int) $this->publish;
                if ($publish === 1 || $publish === 0) {
                    return [];
                }
                return [
                    'title' => ['required'],
                ];
            case 'POST':
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
        ];
    }
}
