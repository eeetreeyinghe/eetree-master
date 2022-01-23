import Layout from '@/page/layout'

export default[
  {
    path: '',
    component: Layout,
    redirect: '/project/list'
  },
  {
    path: '/doc',
    component: Layout,
    children: [
      {
        name: 'doc',
        path: 'list/:id?',
        components: require('@/page/doc/list'),
        meta: {title: '我的文档', icon: 'doc'},
      }
    ],
  },
  {
    path: '/favorite',
    component: Layout,
    children: [
      {
        name: 'favorite',
        path: 'list',
        components: require('@/page/favorite/list'),
        meta: {title: '我的收藏', icon: 'shoucang'},
      }
    ],
  },
  {
    path: '/comment',
    component: Layout,
    children: [
      {
        name: 'comment',
        path: 'list',
        components: require('@/page/comment/list'),
        meta: {title: '我的评论', icon: 'pinglun'},
      }
    ],
  },
  {
    path: '/project',
    component: Layout,
    children: [
      {
        name: 'project',
        path: 'list',
        components: require('@/page/project/list'),
        meta: {title: '我的项目', icon: 'myproject'},
      },
      {
        name: 'project_edit',
        path: 'edit/:id?',
        hidden: true,
        components: require('@/page/project/edit'),
      }
    ],
  },
  {
    path: '/order',
    component: Layout,
    children: [
      {
        name: 'order',
        path: 'list',
        components: require('@/page/order/list'),
        meta: {title: '我的订单', icon: 'myorder'},
      }
    ],
  },
  {
    path: '/revenue',
    component: Layout,
    children: [
      {
        name: 'revenue',
        path: 'list',
        components: require('@/page/revenue/list'),
        meta: {title: '我的收入', icon: 'income'},
      }
    ],
  },
  // {
  //   path: '/follow',
  //   component: Layout,
  //   children: [
  //     {
  //       name: 'follow',
  //       path: 'list',
  //       components: require('@/page/follow'),
  //       meta: {title: '关注、被关注', icon: 'follow'},
  //     }
  //   ],
  // },
  {
    path: '/profile',
    component: Layout,
    children: [
      {
        name: 'profile',
        path: 'set',
        components: require('@/page/user/profile'),
        meta: {title: '个人资料', icon: 'ziliao'},
      }
    ],
  },
  {
    path: '/address',
    component: Layout,
    children: [
      {
        name: 'addressList',
        path: 'address',
        components: require('@/page/address/list'),
        meta: {title: '我的地址', el_icon: 'el-icon-location-outline'},
      }
    ],
  },
  {
    path: '/notice',
    component: Layout,
    children: [
      {
        name: 'notice',
        path: 'list',
        components: require('@/page/notice/list'),
        meta: {title: '我的消息', icon: 'message'},
      }
    ],
  },
];
