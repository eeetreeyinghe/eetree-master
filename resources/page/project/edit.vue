<template>
 <div>
    <div class="flex flex-between flex-center-v margin-b-25">
      <h2 class="right-tab-title">我的项目</h2>
      <div class="flex">
        <el-button class="btn-right-tab flex flex-center margin-r-25" @click="publishProject">
          发布
        </el-button>
        <el-button v-if="draftId" class="btn-right-tab flex flex-center margin-r-25" @click="previewProject">
          预览
        </el-button>
      </div>
    </div>
    <div class="panel panel-default">
      <el-tabs v-model="activeName" @tab-click="handleClick">
        <el-tab-pane label="基本信息" name="1">
          <ProTab1 ref="pro1" :projectCnf="projectCnf" :userInfo="userInfo" @freshProject="freshProject" />
        </el-tab-pane>
        <el-tab-pane label="进度" name="2">
          <ProTab2 ref="pro2"/>
        </el-tab-pane>
        <el-tab-pane label="软硬件" name="3">
          <ProTab3 ref="pro3" :projectCnf="projectCnf" :userInfo="userInfo" />
        </el-tab-pane>
        <el-tab-pane label="视频课程" name="6">
          <ProTab6 ref="pro6" :projectCnf="projectCnf" />
        </el-tab-pane>
        <el-tab-pane label="应用案例" name="4">
          <ProTab4 ref="pro4" :projectCnf="projectCnf" />
        </el-tab-pane>
        <el-tab-pane label="商品" name="5">
          <ProTab5 ref="pro5" :projectCnf="projectCnf" />
        </el-tab-pane>
      </el-tabs>
    </div>
 </div>
</template>

<script>
import { ProTab1, ProTab2, ProTab3, ProTab4, ProTab5, ProTab6 } from './components'
import { getEnums } from '@/js/api/common'
import { getUserInfo } from '@/js/api/user'
import { publishProject } from '@/js/api/project'

export default {
  components:{ ProTab1,ProTab2, ProTab3, ProTab4, ProTab5, ProTab6 },
  data () {
    return {
      activeName: '1',
      projectCnf: {
        projectId: 0,
        type: [],
        cloudTypes: {
          DIAGRAM: { k:-1, l:''},
          ATTACHMENT: { k:-1, l:''},
          HTML: { k:-1, l:''}
        },
      },
      userInfo: {
        is_admin: false,
      },
      draftId: this.$route.params.id
    }
  },
  created() {
    this.getProjectConfig()
  },
  methods: {
    async getProjectConfig() {
      const res = await getEnums('project', 'all')
      res.data.projectId = this.projectCnf.projectId
      this.projectCnf = res.data
      this.userInfo = await getUserInfo()
      if (!this.userInfo.is_admin) {
        delete this.projectCnf.type.ACTIVITY
      }
    },
    handleClick() {
      this.$refs['pro' + this.activeName].initTab()
    },
    freshProject() {
      this.draftId = this.$route.params.id
    },
    async publishProject() {
      if (this.activeName == '1' || this.activeName == '3') {
        this.$refs['pro' + this.activeName].submitForm(true).then(ret => {
          if (ret) {
            this.doPublish()
          }
        })
      } else {
        this.doPublish()
      }
    },
    async doPublish() {
      await publishProject(this.draftId)
      const _self = this
      this.$notify({
        title: 'Success',
        message: '操作成功',
        type: 'success',
        onClose: function() {
          _self.$router.push('/project/list')
        }
      })
    },
    previewProject() {
      window.open(`/project-drafts/${this.draftId}/preview`)
    }
  }
}
</script>
