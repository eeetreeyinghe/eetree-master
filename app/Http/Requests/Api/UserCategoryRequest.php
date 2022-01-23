<?php

namespace App\Http\Requests\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserCategoryRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
                return [
                    'id' => ['required'],
                ];
            case 'POST':
                $parentId = (int) $this->parent_id;
                return [
                    'parent_id' => ['required', 'numeric'],
                    'name' => ['required', Rule::unique('user_category')->where(function ($query) use ($parentId) {
                        return $query->where([
                            ['parent_id', $parentId],
                            ['user_id', Auth::id()],
                        ])->whereNull('deleted_at');
                    })],
                ];
            case 'PUT':
                $category = $this->category;
                return [
                    'name' => ['required', Rule::unique('user_category')->where(function ($query) use ($category) {
                        return $query->where([
                            ['parent_id', $category->parent_id],
                            ['id', '<>', $category->id],
                            ['user_id', Auth::id()],
                        ])->whereNull('deleted_at');
                    })],
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
            'parent_id.required' => '层级不能为空！',
        ];
    }
}
