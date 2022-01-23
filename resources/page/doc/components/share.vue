<template>
<div>
  <div class="panel panel-default">
    <el-table
      :data="list"
      v-loading="listLoading"
      style="width: 100%;min-height:300px;">
      <div slot="empty"></div>
      <el-table-column
        label="名称"
        align="left"
        width="500">
        <template slot-scope="scope">
          <a :href="'/doc/edit/' + scope.row.id" class="flex flex-center-v">
            <div class="image-father"><img class="icon-center" src="/img/icons/doc.svg"></div>{{ scope.row.title }}
          </a>
        </template>
      </el-table-column>
      <el-table-column
        label="分享时间"
        align="center"
        width="160">
        <template slot-scope="scope">
          <div class="created-time-el">{{ scope.row.shared_at }}</div>
        </template>
      </el-table-column>
      <el-table-column label="操作"  align="center" width="150">
        <template slot-scope="scope">
          <el-popover trigger="hover" placement="bottom">
            <ul class="flex-ul-center">
              <li>
                <a :href="'/doc/share/' + scope.row.id" class="flex">
                  <div class="image-father"><img class="icon-center margin-r-5" src="/img/icons/share.svg"/></div>
                  分享链接
                </a>
              </li>
            </ul>
            <div slot="reference" class="name-wrapper flex flex-center">
              <div class="image-father"><img class="icon-center margin-r-5" src="/img/icons/set-img.svg"/></div>
            </div>
          </el-popover>
        </template>
      </el-table-column>
    </el-table>

    <pagination v-show="total>listQuery.limit" :limit="listQuery.limit" :total="total" :page.sync="listQuery.page" @pagination="getList" />
  </div>
</div>
</template>

<script>
import { getDocs } from '@/js/api/doc'
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
    }
  },
  created() {
    this.getList()
  },
  methods: {
    async getList() {
      this.listLoading = true;
      const res = await getDocs({
        page: this.listQuery.page,
        type: 'share',
      });
      this.list = res.data
      this.listQuery.page = res.meta.current_page
      this.listQuery.limit = res.meta.per_page
      this.total = res.meta.total
      this.listLoading = false
    },
  }
}
</script>