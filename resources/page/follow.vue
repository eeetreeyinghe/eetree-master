<!-- 
// 收入
-->
<template>
 <div>
    <div class="flex flex-between flex-center-v margin-b-25">
      <h2 class="right-tab-title">我的关注</h2>
    </div>
    <div class="panel panel-default">
      <el-tabs v-model="activeName" @tab-click="handleClick">
        <el-tab-pane label="关注" name="1">
          <ul class="follow-list flex flex-center-v"> 
            <li class="follow-item-li">
              <img src="/img/avatar.png" alt="头像-水球">
              <h4>水球泡</h4>
              <h5>关注 999</h5>
              <button class="btn-list-new btn-new-active">取消关注</button>
            </li>
            <li class="follow-item-li">
              <img src="/img/avatar.png" alt="头像-水球">
              <h4>水球泡</h4>
              <h5>关注 999</h5>
              <button class="btn-list-new btn-new-active">取消关注</button>
            </li>
          </ul>
        </el-tab-pane>
        <el-tab-pane label="被关注" name="2">
          <ul class="follow-list flex flex-center-v"> 
            <li class="follow-item-li">
              <img src="/img/avatar.png" alt="头像-水球">
              <h4>水球泡</h4>
              <h5>关注 999</h5>
            </li>
            <li class="follow-item-li">
              <img src="/img/avatar.png" alt="头像-水球">
              <h4>水球泡</h4>
              <h5>关注 999</h5>
            </li>
          </ul>
        </el-tab-pane>
      </el-tabs>
    </div>
 </div>
</template>

<script>
export default {
  data () {
    return {
      loading: false,
      docs:[],
      activeName: '1'
    }
  },
  created() {
    this.getList(1)
  },
  methods: {
    async getList (page){
    },
    handleClick({index,label}, event) {
      console.log(index,label);
    }
  }
}
</script>

<style>

 
</style>
