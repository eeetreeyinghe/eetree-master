<?php

namespace App\Http\Requests;

use App\Helpers\Enums;

class ProjectDraftRequest extends FormRequest
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
                ];
            case 'PUT':
                if ($this->route()->getName() === 'projectDraft.updateProducts') {
                    return [
                        'products' => ['array', 'max:' . config('eetree.project.maxProduct')],
                        'products.*' => 'integer',
                        'vProducts' => 'present',
                    ];
                } elseif ($this->route()->getName() === 'projectDraft.updateClouds') {
                    return [
                        'clouds' => ['array', 'max:' . config('eetree.project.maxCloud')],
                    ];
                } elseif ($this->route()->getName() === 'projectDraft.updateRelates') {
                    return [
                        'relates' => ['array', 'max:' . config('eetree.project.maxProduct')],
                        'relates.*' => 'integer',
                    ];
                } else {
                    return [
                        'title' => ['required', 'max:100'],
                        'summary' => ['min:30', 'max:120'],
                        'video_code' => ['present'],
                        'cloud_id' => ['required', 'numeric'],
                        'type' => ['required', 'in:' . implode(',', Enums::keys('project.type'))],
                        'fund_goal' => ['required', 'regex:/^\d{1,8}(\.\d{1,2})?$/'],
                        'start_at' => ['nullable', 'date'],
                        'end_at' => ['nullable', 'date', 'after:' . \Carbon\Carbon::now()],
                        'tags' => ['array', 'max:' . config('eetree.project.maxTag')],
                        // 'tags.*' => 'integer',
                        'college_id' => ['required', 'numeric'],
                        'team_intro' => ['present'],
                        'description' => ['required'],
                        'rule' => 'present',
                        'promote' => ['required', 'in:0,1'],
                        'has_agreement' => ['required', 'in:0,1'],
                        'agreement' => ['present'],
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
            'title.required' => '标题不能为空',
            'title.max' => '标题不能超过100个字',
            'summary.min' => '摘要请控制在 30 到 120 字之间',
            'summary.max' => '摘要请控制在 30 到 120 字之间',
            'description.required' => '描述不能为空',
            'cloud_id.required' => '封面图必须上传',
            'cloud_id.numeric' => '封面图上传有误',
            'type.required' => '请选择项目类型',
            'type.in' => '请选择项目类型',
            'fund_goal.required' => '目标金额不能为空',
            'fund_goal.regex' => '目标金额必须在 0 - 99999999.99 之间, 最多两位小数',
            'start_at.date' => '时间格式有误',
            'end_at.date' => '时间格式有误',
            'end_at.after' => '结束时间不能小于当前时间',
            'tags.array' => '标签选择有误',
            // 'tags.*' => '标签选择有误',
            'tags.max' => '标签最多' . config('eetree.project.maxTag') . '个',
            'products.*' => '软硬件选择有误',
            'products.max' => '软硬件最多' . config('eetree.project.maxProduct') . '个',
            'clouds.max' => '上传文件最多' . config('eetree.project.maxCloud') . '个',
            'relates.*' => '平台选择有误',
            'relates.max' => '平台最多' . config('eetree.project.maxProduct') . '个',
            'has_agreement.required' => '项目参数有误',
            'has_agreement.in' => '项目参数有误',
            'promote.required' => '项目参数有误',
            'promote.in' => '项目参数有误',
        ];
    }
}
