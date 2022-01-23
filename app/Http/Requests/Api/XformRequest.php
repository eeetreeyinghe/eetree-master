<?php

namespace App\Http\Requests\Api;

class XformRequest extends FormRequest
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
                    'data' => ['required'],
                ];
            case 'PUT':
                return [
                    'name' => ['required'],
                    'data' => ['required'],
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
            'data.required' => '请选择表单项',
        ];
    }
}
