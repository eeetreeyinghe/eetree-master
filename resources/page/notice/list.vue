<template>
 <div>
    <div class="flex flex-between flex-center-v margin-b-25">
      <h2 class="right-tab-title">消息通知</h2>
    </div>
    <div class="notice-list" v-loading="listLoading" style="min-height:300px;">
      <ul>
        <li v-for="(row, index) in list" :key="'notice-' + index">
          <div class="flex flex-between">
            <span class="noticeTag">【系统消息】</span>
            <span class="created-time">{{ row.created_at }}</span>
          </div>
          <p class="list-group-bg-text" v-html="row.content"></p>
        </li>
      </ul>
      <pagination v-show="total>listQuery.limit" :limit="listQuery.limit" :total="total" :page.sync="listQuery.page" @pagination="getList" />
    </div>
 </div>
</template>

<script>
import { getNotices } from '@/js/api/user'
import Pagination from '@/js/components/Pagination'
export default {
  name: 'TabPane',
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
      const res = await getNotices({
        page: this.listQuery.page,
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
