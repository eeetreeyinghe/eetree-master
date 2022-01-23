<?php

namespace App\Http\Requests\Api;

use App\Helpers\Enums;

class UserRequest extends FormRequest
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
                    'name' => ['required', 'regex:/^[a-zA-Z][a-zA-Z0-9_\-\.]+$/', 'min:3', 'max:30', 'unique:user,name'],
                    'nickname' => ['required', 'unique:user,nickname'],
                    'password' => ['required', 'max:16', 'min:5'],
                ];
            case 'PUT':
                $types = Enums::keys('user.types');
                foreach ($types as $k => $type) {
                    if ($type == Enums::key('user.types.SUPER')) {
                        unset($types[$k]);
                        break;
                    }
                }
                $rules = [
                    'name' => ['required', 'regex:/^[a-zA-Z][a-zA-Z0-9_\-\.]+$/', 'min:3', 'max:30', 'unique:user,name,' . $this->user->id],
                    'nickname' => ['required', 'unique:user,nickname,' . $this->user->id],
                    'user_type' => ['required', 'in:' . implode(',', $types)],
                ];
                if (!empty($this->password)) {
                    $rules['password'] = ['max:16', 'min:5'];
                }
                return $rules;
            case 'PATCH':
            case 'DELETE':
            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'name.required' => '用户名必填',
            'name.unique' => '用户名已存在',
            'nickname.required' => '昵称必填',
            'nickname.unique' => '昵称已存在',
        ];
    }
}
