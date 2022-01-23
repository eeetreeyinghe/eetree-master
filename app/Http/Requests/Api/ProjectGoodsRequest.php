<?php

namespace App\Http\Requests\Api;

class ProjectGoodsRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
                return [
                    'id' => ['required'],
                ];
            case 'PUT':
                return [
                    'xform_id' => ['required', 'numeric'],
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
            'xform_id.required' => '表单绑定有误',
            'xform_id.numeric' => '表单绑定有误',
        ];
    }
}
