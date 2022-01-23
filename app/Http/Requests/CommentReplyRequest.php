<?php

namespace App\Http\Requests;

class CommentReplyRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
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
            'content.required' => '请填写评论内容',
        ];
    }
}
