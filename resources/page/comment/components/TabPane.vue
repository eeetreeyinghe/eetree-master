<template>
    <div class="panel panel-default">
      <el-table v-loading="listLoading" :data="list" style="width: 100%; min-height:300px;">
        <el-table-column type="expand">
          <template slot-scope="props">
            <el-form label-position="left" inline class="table-expand">
              <el-form-item label="">
                <span>{{ props.row.content }}</span>
              </el-form-item>
            </el-form>
          </template>
        </el-table-column>
        <el-table-column  align="left" label="名称" width="500">
          <template slot-scope="scope">
            <div class="flex flex-center-v">
              <i class="el-icon-document"></i>
              <div class="overflowContent">{{ scope.row.content }}</div>
            </div>
          </template>
        </el-table-column>
        <el-table-column align="center" label="评论时间" width="160">
          <template slot-scope="scope">
            <div class="created-time-el">{{ scope.row.created_at }}</div>
          </template>
        </el-table-column>
        <el-table-column align="center" label="操作"  width="150">
          <template slot-scope="scope">
            <el-button plain @click="handleView(scope.row)">
              查看
            </el-button>
          </template>
        </el-table-column>
      </el-table>

      <pagination v-show="total>listQuery.limit" :limit="listQuery.limit" :total="total" :page.sync="listQuery.page" @pagination="getList" />
    </div>
</template>

<script>
import { userComments } from '@/js/api/user'
import enums from '@/js/utils/enums'
import Pagination from '@/js/components/Pagination'
import { deepClone } from '@/js/utils'
export default {
  name: 'TabPane',
  components: { Pagination },
  props: {
    tab: {
      type: String,
      default: 'doc'
    }
  },
  data () {
    return {
      listLoading: false,
      total: 0,
      listQuery: {
        page: 1,
        limit: 10,
      },
      list:[],
    }
  },
  created() {
    this.getList()
  },
  methods: {
    async getList() {
      this.listLoading = true;
      let type;
      if (this.tab === 'doc') {
        type = enums.types.doc;
      } else {
        type = enums.types.project;
      }
      const res = await userComments({
        page: this.listQuery.page,
        type,
      })
      this.list = res.data
      this.listQuery.page = res.meta.current_page
      this.listQuery.limit = res.meta.per_page
      this.total = res.meta.total
      this.listLoading = false
    },
    showCardFun(id){
      let list = deepClone(this.list)
      list.forEach(element => {
        if(element.id == id){
          element.isShowdetail = !element.isShowdetail
        }
      })
      this.list = list
    },
    handleView(row) {
      location.href = row.url
    }
  }
}
</script>
<style lang="css" scoped>
  .details{
    border-top: 1px dashed #d4d4d4;
    margin-top: 10px;
    padding-top: 10px;
  }
  .show-btn-r{
    width: 30px;
    height: 30px;
    text-align: center;
    cursor: pointer;
  }
  .table-expand >>> .el-form-item{
    margin-bottom:0;
  }
  .el-icon-document{
    margin-right: 5px;
    font-size: 20px;
    color: #777;
  }
  
</style>
