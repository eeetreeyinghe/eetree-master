<template>
 <div>
    <div class="flex flex-between flex-center-v margin-b-25">
      <h2 class="right-tab-title">我的项目</h2>
      <div class="flex flex-between flex-center-v margin-b-25">
        <el-button class="btn-right-tab flex flex-center" @click="addProject">
          <div class="image-father"><img class="icon-center" src="/img/icons/myproject.svg"></div>发布新项目
        </el-button>
      </div>
    </div>
    <div class="panel panel-default" v-loading="listLoading">
      <div class="list-panel-header">
        <div class="list-name float-left flex flex-center-v">
          <div style="width:135px; padding-left:15px;">项目图片</div> 
          项目名称
        </div>
        <div class="list-last-time float-left">创建时间</div>
        <div class="list-handle float-right">状态/操作</div>
      </div>
      <ul class="list-group clearpadding">
        <li class="list-group-item flex flex-center-v" v-for="row in list" :key="'project-' + row.id">
          <router-link v-if="row.status != enums.status.submit" :to="'/project/edit/' + row.id" class="flex flex-center-v" style="padding-left:0;"> 
            <img class="img-left" :src="row.cloud.url"/>
            <div class="list-group-item-dec">
              <h4>{{ row.title }}</h4>
              <el-tag size="small">{{ row.type_label }}</el-tag>
            </div>
          </router-link>
          <div v-else class="flex flex-center-v draft-a" style="padding-left:0;">
            <img class="img-left" :src="row.cloud.url"/>
            <div class="list-group-item-dec">
              <h4>{{ row.title }}</h4>
              <el-tag size="small">{{ row.type_label }}</el-tag>
              <el-tag type="warning" size="small">审核中</el-tag>
            </div>
          </div>
          <span class="created-time">{{ row.created_at }}</span>
          <div class="list-handle-select flex flex-center">
            <button v-if="row.project_id === 0" class="btn-new-del" style="margin-right:10px;" @click="handleDelete(row)">删除</button>
            <button v-if="row.status == enums.status.submit" class="btn-list-new" @click="cancelSubmit(row)">取消审核</button>
            <a v-else-if="row.status == enums.status.pass" :href="row.url" target="_blank" class="btn-list-new">{{ row.status_label }}</a>
            <router-link v-else :to="'/project/edit/' + row.id" class="btn-list-new">{{ row.status_label }}</router-link>
          </div>
          <p v-if="row.status == enums.status.refuse" class="error-list flex flex-center-v"><img src="/img/icons/error-red.svg"/>拒绝原因：{{ row.review_remarks }}</p>
        </li>
      </ul>
      <pagination v-show="total>listQuery.limit" :limit="listQuery.limit" :total="total" :page.sync="listQuery.page" @pagination="getList" />
    </div>
 </div>
</template>

<script>
import { getProjects, cancelSubmit, deleteProject } from '@/js/api/project'
import Pagination from '@/js/components/Pagination'
import enums from '@/js/utils/enums'

export default {
  components:{ Pagination },
  data () {
    return {
      listLoading: false,
      total: 0,
      listQuery: {
        page: 1,
        limit: 10,
      },
      list:[],
      enums,
    }
  },
  created() {
    this.getList()
  },
  methods: {
    async getList() {
      this.listLoading = true;
      const res = await getProjects({
        page: this.listQuery.page,
      });
      this.list = res.data
      this.listQuery.page = res.meta.current_page
      this.listQuery.limit = res.meta.per_page
      this.total = res.meta.total
      this.listLoading = false
    },
    async cancelSubmit(row) {
      const res = await cancelSubmit(row.id)
      this.$notify({
        title: 'Success',
        message: '操作成功',
        type: 'success',
      })

      for (let index = 0; index < this.list.length; index++) {
        if (this.list[index].id === row.id) {
          this.list.splice(index, 1, res.data)
          break
        }
      }
    },
    async handleDelete(row) {
      this.$confirm('确定要删除吗', '警告', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
      })
        .then(async() => {
          await deleteProject(row.id)
          for (let index = 0; index < this.list.length; index++) {
            if (this.list[index].id === row.id) {
              this.list.splice(index, 1)
              break
            }
          }
          this.$notify({
            title: 'Success',
            message: '操作成功',
            type: 'success'
          })
        })
        .catch(err => {})
    },
    addProject() {
      this.$router.push('/project/edit')
    }
  }
}
</script>
