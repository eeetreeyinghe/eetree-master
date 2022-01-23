<template>
  <div class="row">
    <div class="clearpadding col-md-12 bread-nav">首页 / 个人文档</div>
    <div class="clearpadding list-panel-left bg-white">
      <div class="panel-heading" :key="route.path" v-for="route in routes">
        <router-link :to="route.path + '/' + route.children[0].path">
          <div class="image-father" v-if="route.children[0].meta.icon">
            <img class="icon-center" :src="'/img/icons/' + route.children[0].meta.icon + '.svg'">
          </div>
          <i v-if="route.children[0].meta.el_icon" :class="route.children[0].meta.el_icon" style="font-size: 20px;margin-right: 6px;"></i>
          {{ route.children[0].meta.title }}
        </router-link>
      </div>
      <div class="panel-heading">
        <a href="/user/cv">
          <i class="el-icon-user" style="font-size: 20px;margin-right: 6px;"></i>
          我的简历
        </a>
      </div>
    </div>
    <div class="list-panel-right bg-white">
      <router-view />
    </div>
  </div>
</template>
<script>

import routes from '@/js/routes'

export default {
  data() {
    return {
      routes: routes.slice(1)
    }
  },
  created() {
    this.routes.forEach(element => {
      element.children[0].path = element.children[0].path.replace(/\/\:[a-z]+\?/,'')
    })
  },
}
</script>
<style lang="scss">
  .bread-nav{
    font-size: 12px;
    color: #999;
    margin-bottom: 10px;
    padding-left: 0;
  }
  .modal-header{
    padding: .815rem 1rem;
  }
  .modal-title{
    font-size: 16px;
    color: #4a4a4a;
    font-weight: normal;
  }
  .modal-backdrop{
    background:rgba(0,0,0,0.6);
  }
  .modal.show .modal-dialog{
    margin-top: 8%;
  }
 
</style>