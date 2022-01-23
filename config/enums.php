<?php
return [
    'user' => [
        'types' => [
            'NORMAL' => ['k' => 0, 'l' => '普通用户'],
            'SUPER' => ['k' => 1, 'l' => '超管'],
            'EDITOR' => ['k' => 2, 'l' => '编辑'],
            'ADMIN' => ['k' => 3, 'l' => '管理员'],
        ],
    ],
    'tag' => [
        'types' => [
            'USER' => ['k' => 0, 'l' => '用户添加'],
            'CLASSIFIED' => ['k' => 1, 'l' => '管理员归类'],
        ],
    ],
    'project' => [
        'type' => [
            'CROWDFUND' => ['k' => 0, 'l' => '众筹类'],
            'SHARE' => ['k' => 1, 'l' => '分享类'],
            'ACTIVITY' => ['k' => 2, 'l' => '活动类'],
        ],
        'cloudTypes' => [
            'DIAGRAM' => ['k' => 0, 'l' => '电路图'],
            'ATTACHMENT' => ['k' => 1, 'l' => '附件'],
            'HTML' => ['k' => 2, 'l' => '物料清单(HTML)'],
        ],
    ],
    'product' => [
        'types' => [
            'COMPONENT' => ['k' => 0, 'l' => '元器件'],
            'SOFTWARE' => ['k' => 1, 'l' => '软件'],
            'TOOL' => ['k' => 2, 'l' => '工具'],
        ],
    ],
    'recommend' => [
        'area' => [
            'HOME_SLIDE' => ['k' => 0, 'l' => '首页轮播(图1920*400)'],
            'HOME_DOC' => ['k' => 1, 'l' => '首页大纲区域'],
            'HOME_PROJECT' => ['k' => 2, 'l' => '首页项目区域'],
            'HOME_WIKI' => ['k' => 3, 'l' => '首页百科区域（首条图片360*500）'],
            'HOME_COURSE' => ['k' => 4, 'l' => '首页课程区域'],
            'HOT_TAG' => ['k' => 5, 'l' => '热门标签'],
        ],
    ],
    'status' => [
        'DRAFT' => ['k' => 0, 'l' => '草稿'],
        'SUBMIT' => ['k' => 1, 'l' => '待审核'],
        'REFUSE' => ['k' => 8, 'l' => '拒绝'],
        'PASS' => ['k' => 9, 'l' => '通过'],
    ],
    'order' => [
        'status' => [
            'NEW' => ['k' => 0, 'l' => '未提交'],
            'SUBMIT' => ['k' => 1, 'l' => '待支付'],
            'PAID' => ['k' => 2, 'l' => '支付成功'],
            'OTHER' => ['k' => 3, 'l' => '失效'],
        ],
        'type' => [
            'NORMAL' => ['k' => 0, 'l' => '正常收入'],
            'PROMOTE' => ['k' => 1, 'l' => '推广收入'],
        ],
    ],
    'types' => [
        'DOC' => ['k' => 0, 'l' => '文档'],
        'PROJECT' => ['k' => 1, 'l' => '项目'],
    ],
    'cacheKey' => [
    ],
    'sessKey' => [
        'wxUser' => 'WX_USER',
        'wxBackUrl' => 'WX_BACK_URL',
    ],
];
