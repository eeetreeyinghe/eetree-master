
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

Vue.component('xy-folder', require('./components/Folder').default)

import VueCropper from 'vue-cropperjs';
Vue.component('vue-cropper', VueCropper)

import VueRouter from 'vue-router';
// import store from './store/'; // vuex 数据存储所需对象
import routes from './routes';    // 路由配置文件
Vue.use(VueRouter);
// 实例化路由
const router = new VueRouter({
    routes
})

const app = new Vue({
    el: '#app',
    // store,
    router,
    created() {
        if (sessionStorage) {
            sessionStorage.removeItem('userinfo')
        }
    }
});