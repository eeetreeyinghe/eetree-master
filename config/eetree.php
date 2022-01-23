<?php
return [
    'cache' => [
        'ttl' => 600,
    ],
    'limit' => 12,
    'maxSearchPage' => 30,
    'adminLimit' => 10,
    'usercategory' => [
        'max' => 100,
    ],
    'captcha' => [
        'register' => true,
        'forget' => true,
    ],
    'order' => [
        'expires' => 24, //hour
    ],
    'default_cloud' => [
        'project_cover_image' => 1,
    ],
    'cloud' => 'qiniu',
    'upload' => [
        'max' => 2048 * 1024, // 图片大小限制, bytes
        'maxFile' => 10240 * 1024,
    ],
    'es' => [
        'hosts' => [env('ES_HOST', 'http://elasticsearch:9200')],
        'index' => [
            'doc' => 'eetree_doc',
            'project' => 'eetree_prj',
        ],
    ],
    'revenue' => [
        'userRatio' => 0.92,
        'platformRatio' => 0.05, //平台分成|用户推广
        'serviceRatio' => 0.03, //服务费
    ],
    'doc' => [
        'maxTag' => 3,
    ],
    'project' => [
        'maxTag' => 10,
        'maxProduct' => 20,
        'maxCloud' => 6,
        'maxDiagram' => 3,
        'maxAttachment' => 1,
    ],
    'templates' => [
        [
            'img' => '/img/templates/empty.png',
            'title' => '空白模板',
            'selected' => true,
        ],
        [
            'img' => '/img/templates/tpl30.jpg',
            'doc_id' => 30,
            'title' => '仪器模板',
        ],
        [
            'img' => '/img/templates/tpl31.jpg',
            'doc_id' => 31,
            'title' => '平台模板',
        ],
        [
            'img' => '/img/templates/tpl32.jpg',
            'doc_id' => 32,
            'title' => '项目模板',
        ],
        [
            'img' => '/img/templates/tpl33.jpg',
            'doc_id' => 33,
            'title' => '器件模板',
        ],
    ],
    'ucenter' => [
        'order' => '#/order/list',
        'project_edit' => '#/project/edit',
    ],
    'wikiUrl' => 'https://www.eetree.io/doc/%s',
    'menus' => [
        [
            'id' => 5,
            'path' => '/doc',
            'component' => 'Layout',
            'redirect' => '/doc/list',
            'meta' => ['title' => '文档', 'icon' => 'documentation'],
            'children' => [
                [
                    'id' => 6,
                    'path' => 'list',
                    'component' => 'doc_list',
                    'name' => 'doc_list',
                    'meta' => ['title' => '文档列表'],
                ],
                [
                    'id' => 7,
                    'path' => 'review',
                    'component' => 'doc_review',
                    'name' => 'doc_review',
                    'meta' => ['title' => '审核列表'],
                ],
            ],
        ],
        [
            'id' => 10,
            'path' => '/project',
            'component' => 'Layout',
            'redirect' => '/project/list',
            'meta' => ['title' => '项目', 'icon' => 'el-icon-s-marketing'],
            'children' => [
                [
                    'id' => 11,
                    'path' => 'list',
                    'component' => 'project_list',
                    'name' => 'project_list',
                    'meta' => ['title' => '项目列表'],
                ],
                [
                    'id' => 12,
                    'path' => 'review',
                    'component' => 'project_review',
                    'name' => 'project_review',
                    'meta' => ['title' => '项目审核'],
                ],
                [
                    'id' => 13,
                    'path' => 'goods_list',
                    'component' => 'goods_list',
                    'name' => 'goods_list',
                    'meta' => ['title' => '商品列表'],
                ],
                // [
                //     'id' => 14,
                //     'path' => 'goods_trial_list',
                //     'component' => 'goods_trial_list',
                //     'name' => 'goods_trial_list',
                //     'meta' => ['title' => '商品试用列表'],
                // ],
                // [
                //     'id' => 15,
                //     'path' => 'goods_trial_review',
                //     'component' => 'goods_trial_review',
                //     'name' => 'goods_trial_review',
                //     'meta' => ['title' => '商品试用审核'],
                // ],
            ],
        ],
        [
            'id' => 20,
            'path' => '/recommend',
            'component' => 'Layout',
            'children' => [
                [
                    'path' => 'list',
                    'component' => 'recommend_list',
                    'name' => 'recommend',
                    'meta' => ['title' => '推荐内容', 'icon' => 'el-icon-collection'],
                ],
            ],
        ],
        [
            'id' => 24,
            'path' => '/form',
            'component' => 'Layout',
            'children' => [
                [
                    'path' => 'list',
                    'component' => 'form_list',
                    'name' => 'form',
                    'meta' => ['title' => '表单', 'icon' => 'el-icon-document'],
                ],
            ],
        ],
        [
            'id' => 23,
            'path' => '/admin',
            'component' => 'Layout',
            'redirect' => '/admin/user',
            'meta' => ['title' => '后台管理', 'icon' => 'el-icon-s-custom'],
            'children' => [
                [
                    'id' => 1,
                    'path' => 'user',
                    'component' => 'admin_user',
                    'name' => 'adminuser',
                    'meta' => ['title' => '后台用户', 'icon' => 'el-icon-s-custom'],
                ],
                [
                    'id' => 2,
                    'path' => 'role',
                    'component' => 'admin_role',
                    'name' => 'role',
                    'meta' => ['title' => '角色管理', 'icon' => 'el-icon-s-check'],
                ],
                [
                    'id' => 3,
                    'path' => 'permission',
                    'component' => 'admin_permission',
                    'name' => 'permission',
                    'meta' => ['title' => '权限管理', 'icon' => 'lock'],
                ],
            ],
        ],
        [
            'id' => 4,
            'path' => '/category',
            'component' => 'Layout',
            'children' => [
                [
                    'path' => 'list',
                    'component' => 'category_list',
                    'name' => 'category',
                    'meta' => ['title' => '分类', 'icon' => 'tree'],
                ],
            ],
        ],
        [
            'id' => 22,
            'path' => '/tag',
            'component' => 'Layout',
            'children' => [
                [
                    'path' => 'list',
                    'component' => 'tag_list',
                    'name' => 'tag',
                    'meta' => ['title' => '标签', 'icon' => 'el-icon-collection-tag'],
                ],
            ],
        ],
        [
            'id' => 8,
            'path' => '/comment',
            'component' => 'Layout',
            'children' => [
                [
                    'path' => 'list',
                    'component' => 'comment_list',
                    'name' => 'comment',
                    'meta' => ['title' => '评论', 'icon' => 'message'],
                ],
            ],
        ],
        [
            'id' => 9,
            'path' => '/user',
            'component' => 'Layout',
            'children' => [
                [
                    'path' => 'list',
                    'component' => 'user_list',
                    'name' => 'user',
                    'meta' => ['title' => '注册用户', 'icon' => 'user'],
                ],
            ],
        ],
        [
            'id' => 16,
            'path' => '/platform',
            'component' => 'Layout',
            'children' => [
                [
                    'path' => 'list',
                    'component' => 'platform_list',
                    'name' => 'platform',
                    'meta' => ['title' => '项目平台', 'icon' => 'el-icon-s-platform'],
                ],
            ],
        ],
        [
            'id' => 25,
            'path' => '/college',
            'component' => 'Layout',
            'children' => [
                [
                    'path' => 'list',
                    'component' => 'college_list',
                    'name' => 'college',
                    'meta' => ['title' => '高校', 'icon' => 'el-icon-school'],
                ],
            ],
        ],
        [
            'id' => 17,
            'path' => '/product',
            'component' => 'Layout',
            'redirect' => '/product/list',
            'meta' => ['title' => '软硬件', 'icon' => 'component'],
            'children' => [
                [
                    'id' => 19,
                    'path' => 'supplier_list',
                    'component' => 'supplier_list',
                    'name' => 'supplier_list',
                    'meta' => ['title' => '厂商管理'],
                ],
                [
                    'id' => 18,
                    'path' => 'product_list',
                    'component' => 'product_list',
                    'name' => 'product_list',
                    'meta' => ['title' => '软硬件管理'],
                ],
            ],
        ],
        [
            'id' => 21,
            'path' => '/order',
            'component' => 'Layout',
            'children' => [
                [
                    'path' => 'list',
                    'component' => 'order_list',
                    'name' => 'order',
                    'meta' => ['title' => '订单', 'icon' => 'money'],
                ],
            ],
        ],
    ],
];
