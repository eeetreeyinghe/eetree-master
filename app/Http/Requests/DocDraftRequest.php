<?php

namespace App\Http\Requests;

class DocDraftRequest extends FormRequest
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
                    'tags' => ['array', 'max:' . config('eetree.doc.maxTag')],
                    // 'tags.*' => 'integer',
                ];
            case 'PUT':
                if ($this->title) {
                    return [
                        'title' => ['required', 'max:100'],
                        'tags' => ['array', 'max:' . config('eetree.doc.maxTag')],
                        // 'tags.*' => 'integer',
                    ];
                }
                return [];
            case 'PATCH':
            case 'DELETE':
            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'title.required' => '名称不能为空',
            'title.max' => '名称不能超过100个字',
            'tags.array' => '标签选择有误',
            // 'tags.*' => '标签选择有误',
            'tags.max' => '标签最多' . config('eetree.doc.maxTag') . '个',
        ];
    }
}
