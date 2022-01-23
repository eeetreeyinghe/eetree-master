<template>
 <div>
    <div class="flex flex-between flex-center-v margin-b-25">
      <h2 class="right-tab-title">我的收入</h2>
      <div class="flex flex-bottom-v right-text-income">
        总收入<h2>¥ {{ userInfo.revenue }}</h2>
        推广分成<h2>¥ {{ userInfo.promote_revenue }}</h2>
      </div>
    </div>
    <div class="panel panel-default">
      <el-table v-loading="listLoading" :data="list" style="width: 100%; min-height:300px;">
        <el-table-column align="left">
          <template slot="header" slot-scope="scope">
            交易时间
            <el-date-picker 
              @change="getList" 
              :clearable="false"
              :editable="false"
              value-format="yyyy"
              class="table-head-date" 
              v-model="years" 
              type="year" 
              placeholder="选择年"
            ></el-date-picker>
          </template>
          <template slot-scope="scope">
            {{ scope.row.paid_at }}
          </template>
        </el-table-column>
        <el-table-column align="center" label="订单">
          <template slot-scope="scope">
            {{ scope.row.title }}
          </template>
        </el-table-column>
        <el-table-column align="center" label="售价">
          <template slot-scope="scope">
            {{ scope.row.fee }}
          </template>
        </el-table-column>
        <el-table-column align="center" label="收入">
          <template slot-scope="scope">
            {{ scope.row.revenue }}
            <el-tag size="small" v-if="scope.row.type_label">{{ scope.row.type_label }}</el-tag>
          </template>
        </el-table-column>
      </el-table>

      <pagination v-show="total>listQuery.limit" :limit="listQuery.limit" :total="total" :page.sync="listQuery.page" @pagination="getList" />
    </div>
 </div>
</template>

<script>
import { getRevenues,getUserInfo } from '@/js/api/user'
import Pagination from '@/js/components/Pagination'
export default {
  components: { Pagination },
  data () {
    return {
      listLoading: false,
      total: 0,
      listQuery: {
        page: 1,
        limit: 10,
      },
      list:[],
      userInfo: {},
      years: new Date().getFullYear().toString()
    }
  },
  created() {
    getUserInfo().then(getUserInfo => {
      this.userInfo = getUserInfo
    })
    this.getList()
  },
  methods: {
    async getList() {
      this.listLoading = true;
      const res = await getRevenues({
        page: this.listQuery.page,
        year: this.years,
      });
      this.list = res.data
      this.listQuery.page = res.meta.current_page
      this.listQuery.limit = res.meta.per_page
      this.total = res.meta.total
      this.listLoading = false
    }
  }
}
</script>
