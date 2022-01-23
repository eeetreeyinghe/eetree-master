<template>
  <div class="tab-container">
    <div class="flex flex-between flex-center-v margin-b-25">
      <h2 class="right-tab-title">我的评论</h2>
    </div>
    <el-tabs v-model="activeName">
      <el-tab-pane v-for="item in tabMapOptions" :key="item.key" :label="item.label" :name="item.key">
        <keep-alive>
          <tab-pane v-if="activeName==item.key" :tab="item.key" />
        </keep-alive>
      </el-tab-pane>
    </el-tabs>
  </div>
</template>

<script>
import tabPane from './components/TabPane'

export default {
  name: 'CommentList',
  components: { tabPane },
  data() {
    return {
      tabMapOptions: [
        { label: '文档', key: 'doc' },
        { label: '项目', key: 'project' }
      ],
      activeName: 'doc'
    }
  }
}
</script>
