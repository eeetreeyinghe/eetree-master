<?php

namespace App\Http\Requests\Api;

use App\Helpers\Enums;

class TagRequest extends FormRequest
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
                ];
            case 'PUT':
                if ($this->pid) {
                    return [
                        'pid' => ['integer'],
                    ];
                } else {
                    return [
                        'name' => ['required'],
                        'type' => ['required', 'in:' . implode(',', Enums::keys('tag.types'))],
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
            'name.required' => '名称不能为空',
            'pid.integer' => '请选择归类标签',
            'type.required' => '类型不能为空',
            'type.in' => '类型不正确',
        ];
    }
}
