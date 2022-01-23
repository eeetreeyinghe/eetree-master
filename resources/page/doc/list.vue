<template>
  <div class="tab-container">
    <div class="flex flex-between flex-center-v margin-b-25">
      <h2 class="right-tab-title">我的文档</h2>
      <div class="flex">
        <el-button v-if="parentId >= 0" class="btn-right-tab flex flex-center margin-r-25"  @click="$refs.docList.toCategory(parentId)">
          <div class="image-father"><img class="icon-center margin-r-5" src="/img/icons/return-icon.svg"/></div>
          上一级</el-button>
        <el-button v-if="activeName == 'docList'" @click="$refs.docList.newCategory()" class="btn-right-tab flex flex-center margin-r-25">
          <div class="image-father"><img class="icon-center margin-r-5" src="/img/icons/folder.svg"/></div>
          新建文件夹
        </el-button>
        <el-button v-if="activeName == 'docList'" @click="$refs.docList.newDoc()" class="btn-right-tab flex flex-center">
          <div class="image-father"><img class="icon-center margin-r-5" src="/img/icons/doc.svg"/></div>
          新建文件
        </el-button>
      </div>
    </div>
    <el-tabs v-model="activeName">
      <el-tab-pane key="docList" label="我的文档" name="docList">
          <tab-list ref="docList" v-if="activeName=='docList'" :parent-id.sync="parentId" :cid="categoryId" />
      </el-tab-pane>
      <el-tab-pane key="docShare" label="我的分享" name="docShare">
          <tab-share v-if="activeName=='docShare'" />
      </el-tab-pane>
      <el-tab-pane key="docSubmit" label="我的提交" name="docSubmit">
          <tab-submit v-if="activeName=='docSubmit'" />
      </el-tab-pane>
    </el-tabs>
  </div>
</template>

<script>
import tabList from './components/list'
import tabShare from './components/share'
import tabSubmit from './components/submit'

export default {
  name: 'FavoriteList',
  components: { tabList, tabShare, tabSubmit },
  data() {
    return {
      activeName: 'docList',
      parentId: -1,
      categoryId: this.$route.params.id ? parseInt(this.$route.params.id) : 0,
    }
  },
}
</script>
