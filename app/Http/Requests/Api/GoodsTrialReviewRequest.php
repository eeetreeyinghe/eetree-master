<?php

namespace App\Http\Requests\Api;

use App\Helpers\Enums;

class GoodsTrialReviewRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
                return [
                    'status' => ['required', 'in:' . implode(',', [Enums::key('status.SUBMIT'), Enums::key('status.REFUSE')])],
                ];
            case 'PUT':
                $rules = [
                    'status' => ['required', 'in:' . implode(',', [Enums::key('status.REFUSE'), Enums::key('status.PASS')])],
                ];
                if ($this->status == Enums::key('status.PASS')) {
                }
                if ($this->status == Enums::key('status.REFUSE')) {
                    $rules['review_remarks'] = ['required'];
                }
                return $rules;
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
            'status.required' => '审核状态不能为空',
            'status.in' => '审核状态不正确',
            'review_remarks.required' => '拒绝原因不能为空',
        ];
    }
}
