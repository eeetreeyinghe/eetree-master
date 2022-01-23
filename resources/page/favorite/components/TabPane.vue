<template>
  <div>
    <div class="panel panel-default">
      <el-table v-loading="listLoading" :data="list" style="width: 100%;min-height:300px;">
        <el-table-column  align="left" label="名称" width="500" >
          <template slot-scope="scope">
            <a :href="scope.row.url" class="flex flex-center-v">
              <div class="image-father"><img class="icon-center" src="/img/icons/doc.svg"></div>
              {{ scope.row.title }}
            </a>
          </template>
        </el-table-column>
        <el-table-column align="center" label="收藏时间" width="160">
          <template slot-scope="scope">
            <div class="created-time-el">{{ scope.row.created_at }}</div>
          </template>
        </el-table-column>
        <el-table-column align="center" label="操作"  width="150">
          <template slot-scope="scope">
            <div class="flex flex-center pointer" title="取消收藏" @click="toggleFavorite(scope.row)"><i :class="scope.row.favorited ? 'el-icon-star-on el-icon-active fontSize26' : 'el-icon-star-off fontSize22'" ></i>
            </div>
          </template>
        </el-table-column>
      </el-table>

      <pagination v-show="total>listQuery.limit" :limit="listQuery.limit" :total="total" :page.sync="listQuery.page" @pagination="getList" />
    </div>
  </div>
</template>

<script>
import Pagination from '@/js/components/Pagination'
import enums from '@/js/utils/enums'
import { getFavorites,addFavorite,cancelFavorite } from '@/js/api/favorite'
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
      const res = await getFavorites({
        page: this.listQuery.page,
        type,
      })
      res.data.forEach(row => {
        row.favorited = true;
      });
      this.list = res.data
      this.listQuery.page = res.meta.current_page
      this.listQuery.limit = res.meta.per_page
      this.total = res.meta.total
      this.listLoading = false
    },
    async toggleFavorite(row) {
      if (row.favorited) {
        this.$confirm('确定取消收藏？', '提示', {
            confirmButtonText: '确定',
            cancelButtonText: '取消',
            type: 'warning'
        }).then(async () => {
          await cancelFavorite(row.id);
          this.$notify({
            title: 'Success',
            message: '操作成功',
            type: 'success'
          })
          this.$set(row,'favorited',false)
        })
        .catch(err => {})
      } else {
        const res = await addFavorite({
          fav_id: row.fav_id,
          type: row.type,
        });
        this.$notify({
          title: 'Success',
          message: '操作成功',
          type: 'success'
        })
        row.id = res.data.id;
        this.$set(row,'favorited',true)
      }
    }
  }
}
</script>
