<template>
 <div>
    <div class="panel panel-default" v-loading="listLoading" style="min-height:300px;">
      <ul class="list-group clearpadding">
        <li class="list-group-border" v-for="(row, index) in list" :key="'order-' + index">
          <div class="order-list-top flex flex-center-v flex-between">
            <div class="order-list-inner-l">
              <h4>{{ row.status_label }}</h4>
              <div class="order-list-text">
                <span class="margin-r25">{{ row.time }}</span>
                <span class="margin-r25">订单号：{{ row.order_no }}</span>
              </div>
            </div>
            <div v-if="row.status != allStatus.paid" class="flex">
              <button class="btn-new-del" @click="handleDelete(row)">删除</button>
              <button v-if="row.status == allStatus.submit" class="btn-list-new btn-new-active margin-l-10" @click="handlePay(row)">去支付</button>
            </div>
          </div>
          <div class="order-list-bottom flex flex-center-v flex-between">
            <a :href="row.goods.url" class="flex flex-center-v" style="padding-left:0;"> 
              <img v-if="row.goods.cloud_url != ''" class="img-left" :src="row.goods.cloud_url"/>
              <div class="list-group-item-dec">
                <h4>{{ row.goods.name }}</h4>
                <p>{{ row.project.title }}</p>
              </div>
            </a>
            <div class="flex flex-end flex-center-v order-price">
              实付金额：<h3>{{ row.total_fee }}</h3> 元
            </div>
          </div>
        </li>
      </ul>
      <pagination v-show="total>listQuery.limit" :limit="listQuery.limit" :total="total" :page.sync="listQuery.page" @pagination="getList" />
    </div>
 </div>
</template>

<script>
import { getOrders, deleteOrder, dopay } from '@/js/api/user'
import Pagination from '@/js/components/Pagination'
import enums from '@/js/utils/enums'

export default {
  components: { Pagination },
  props: {
    tab: {
      type: String,
      default: 'all'
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
      enums,
      allStatus: enums.order.status,
    }
  },
  created() {
    this.getList()
  },
  methods: {
    async getList() {
      this.listLoading = true;
      const res = await getOrders({
        page: this.listQuery.page,
        status: this.tab,
      });
      this.list = res.data
      this.listQuery.page = res.meta.current_page
      this.listQuery.limit = res.meta.per_page
      this.total = res.meta.total
      this.listLoading = false
    },
    async handleDelete(row) {
      this.$confirm('确定要删除吗', '警告', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
      })
        .then(async() => {
          await deleteOrder(row.id)
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
    async handlePay(row) {
      this.listLoading = true
      const res = await dopay(row.id)
      if (res.data.payurl) {
        location.href = res.data.payurl
      } else {
        WeixinJSBridge.invoke(
          'getBrandWCPayRequest', res.data,
          function(res) {
            if (res.err_msg == "get_brand_wcpay_request:ok") {
              location.href = `/pay/success?pid=${row.project.id}`
            }
          }
        )
        this.listLoading = false
      }
    },
  }
}
</script>
<style scoped>
  .margin-r25{
    margin-right:25px;
  }
  .margin-l-10{
    margin-left: 10px;
  }

</style>