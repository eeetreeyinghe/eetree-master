<?php

namespace App\Http\Requests\Api;

class GoodsPromoteRequest extends FormRequest
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
            'date.required' => '推广时间段不能为空',
            'threshold.required' => '购买阀值不能为空',
        ];
    }
}
