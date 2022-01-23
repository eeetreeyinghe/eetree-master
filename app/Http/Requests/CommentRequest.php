<?php

namespace App\Http\Requests;

class CommentRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'item' => ['required', 'integer'],
                    'content' => ['required'],
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
            'item.required' => '评论参数有误',
            'item.integer' => '评论参数有误',
            'content.required' => '请填写评论内容',
        ];
    }
}
