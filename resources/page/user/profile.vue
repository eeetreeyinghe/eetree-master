<template>
 <div>
    <div class="flex flex-between flex-center-v margin-b-25">
      <h2 class="right-tab-title">个人资料</h2>
    </div>
    <div class="ziliao-ground flex flex-center-t">
      <div class="ziliao-left">
        <!-- 需要裁剪头像，换一个组件 -->
        <upload-avatar :crop-opt="cropOpt" :cloud="cloud" />
        <!-- <p class="text-hover" >上传头像</p> -->
      </div>
      <div class="ziliao-right">
        <el-form :model="userInfo" ref="userForm" label-width="100px" class="demo-userInfo">
          <el-form-item label="用户名" prop="name">
            <el-input v-model="userInfo.name" disabled></el-input>
          </el-form-item>
          <el-form-item label="昵称" prop="nickname">
            <el-input v-model="userInfo.nickname" disabled></el-input>
          </el-form-item>
          <el-form-item label="支付宝" prop="alipay_account">
            <el-input v-model="userInfo.alipay_account"></el-input>
          </el-form-item>
          <el-form-item label="个人介绍" prop="intro">
            <el-input type="textarea" v-model="userInfo.intro"></el-input>
          </el-form-item>
          <el-form-item>
            <el-button style="width:210px;" plain @click="submitForm()">保存</el-button>
          </el-form-item>
        </el-form>
      </div>
    </div>
 </div>
</template>

<script>
import { getUserInfo, updateUser, uploadAvatarUrl } from '@/js/api/user'
import UploadAvatar from '@/js/components/Upload/Avatar.vue'
export default {
  components: { UploadAvatar },
  data () {
    return {
      userInfo: {
        name: '',
        nickname: '',
        alipay_account: '',
        intro: ''
      },
      cropOpt: {
        width: 300,
        height: 300,
        storage: 'local',
        url: uploadAvatarUrl()
      },
      cloud: {
        url: ''
      }
    }
  },
  created() {
    this.getUserInfo()
  },
  methods: {
    async getUserInfo() {
      this.userInfo = await getUserInfo();
      this.cloud.url = this.userInfo.avatar
    },
    async submitForm() {
      await updateUser({
        alipay_account: this.userInfo.alipay_account,
        intro: this.userInfo.intro,
      })
      this.$notify({
        title: 'Success',
        message: '资料提交成功',
        type: 'success'
      })
    }
  }
}
</script>
