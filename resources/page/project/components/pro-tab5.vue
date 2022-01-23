<template>
  <div>
    <div class="pro-step-list">
      <ul v-loading="listLoading" :class="minHeight">
        <li class="flex flex-bottom-v flex-between" v-for="(row, index) in list" :key="'goods' + row.id" @click="handleEdit(row, index, $event)">
          <div class="left-part flex flex-center-v">
            <img class="goods-img" :src="row.cloud.url"/>
            <div>
              <h6>{{ row.name }}</h6>
              <p>{{ row.description }}</p>
            </div>
          </div>
          <img class="pos-right" src="/img/icons/del-img.svg"/>
        </li>
      </ul>
    </div>
    <div class="buttonFill flex flex-center" @click="handleAddGoods">
      <i class="el-icon-circle-plus-outline margin-r-8"></i> 添加商品
    </div>
    <el-dialog class="moveModal" :visible.sync="dialogVisible" :title="dialogType==='edit'?'编辑':'添加'" width="70%">
      <div class="step-form">
        <el-form ref="goodsForm" :model="goods" :rules="rules" label-width="85px" class="widthForm100 no-radius">
          <el-form-item label="商品图片" prop="cloud_id">
            <Upload v-model="goods.cloud_id" :cloud="goods.cloud" :crop-opt="imageOptionsGoods"/>
          </el-form-item>
          <el-form-item label="名称" prop="name">
            <el-input v-model="goods.name" placeholder="请填写标题"></el-input>
          </el-form-item>
          <el-form-item label="价格" prop="price">
            <el-input v-model="goods.price" placeholder="请填写价格"></el-input>
          </el-form-item>
          <el-form-item label="描述" prop="description">
            <el-input type="textarea" :rows="3" placeholder="请输入商品介绍" v-model="goods.description"></el-input>
          </el-form-item>
          <el-form-item label="外链" prop="link" v-if="userInfo.is_admin">
            <el-input v-model="goods.link" placeholder="请填写商品外链"></el-input>
          </el-form-item>
        </el-form>
      </div>
      <div slot="footer" class="dialog-footer">
        <el-button size="sm" class="button-new" v-loading="saving" @click="confirmSubmit">保存</el-button>
      </div>
    </el-dialog>
  </div>
</template>
<script>
import Upload from '@/js/components/Upload/Crop.vue'
import { getGoods, addGoods, updateGoods, deleteGoods } from '@/js/api/project'
import { getUserInfo } from '@/js/api/user'
import { deepClone, checkCloud } from '@/js/utils'
const defaultGoods = {
  cloud_id: 0,
  cloud: {
    url: '',
  },
  name:'',
  price: '',
  link: '',
  description:'',
};
export default {
  components: { Upload },
  data () {
    return{
      minHeight: 'minH100',
      saving: false,
      isInit: false,
      listLoading: false,
      draftId: this.$route.params.id,
      list: [],
      dialogVisible: false,
      dialogType: 'new',
      goods: Object.assign({}, defaultGoods),
      userInfo: {
        is_admin: false,
      },
      imageOptionsGoods:{
        width: 480,
        height: 270,
        noCircle:true,
        isShowUpText:false,
        isShowRtext:false,
        imgDesc:'商品图片',
        imgSize:'small',
        style:'width:240px;height:136px;padding: 0;'
      },
      rules: {
        cloud_id: [
          { required: true, message: '请上传图片', trigger: 'blur' },
          { validator: checkCloud, trigger: 'blur' }
        ],
        name: [
          { required: true, message: '请填写名称', trigger: 'blur' }
        ],
        price: [
          { required: true, message: '请填写价格', trigger: 'blur' },
        ],
        description:[
          { required: true, message: '请填写描述', trigger: 'blur' }
        ]
      }
    }
  },
  methods:{
    async initTab() {
      if (!this.draftId) {
        this.draftId = this.$route.params.id
      }
      if (!this.isInit) {
        this.userInfo = await getUserInfo()
        this.getList()
        this.isInit = true;
      }
    },
    async getList() {
      this.listLoading = true;
      const res = await getGoods({
        draft_id: this.draftId
      });
      if(res.data.length==0){
        this.minHeight = 'noHeight'
      }
      this.list = res.data
      this.listLoading = false
    },
    handleAddGoods() {
      this.goods = deepClone(defaultGoods)
      this.dialogType = 'new'
      this.dialogVisible = true
    },
    handleEdit(row, index, event) {
      if (event.target.className == 'pos-right') {
        this.handleDelete(row, index)
      } else {
        this.dialogType = 'edit'
        this.dialogVisible = true
        this.goods = deepClone(row)
      }
    },
    handleDelete(row, index) {
      this.$confirm('确定要删除吗', '警告', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
      })
        .then(async() => {
          await deleteGoods(row.id)
          this.list.splice(index, 1)
          this.$notify({
            title: 'Success',
            message: '操作成功',
            type: 'success'
          })
          if(this.list.length==0){
            this.minHeight = 'noHeight'
          }
        })
        .catch(err => {})
    },
    fields(goods) {
      return {
        draft_id: this.draftId,
        cloud_id: goods.cloud_id,
        name: goods.name,
        price: goods.price,
        link: goods.link,
        description: goods.description
      }
    },
    async confirmSubmit() {
      if (this.saving) {
        return
      }
      this.$refs['goodsForm'].validate(async (valid) => {
        this.saving = true
        try {
          if (valid) {
            const isEdit = this.dialogType === 'edit'
            if (isEdit) {
              await updateGoods(this.goods.id, this.fields(this.goods))
              for (let index = 0; index < this.list.length; index++) {
                if (this.list[index].id === this.goods.id) {
                  this.list.splice(index, 1, Object.assign({}, this.goods))
                  break
                }
              }
            } else {
              const { data } = await addGoods(this.fields(this.goods))
              this.goods.id = data.id
              this.list.push(this.goods)
            }

            this.dialogVisible = false
            this.$notify({
              title: '保存成功',
              message: '操作成功',
              type: 'success'
            })
          }
          this.saving = false
        } catch (error) {
          this.saving = false
          throw error
        }
      });
    }
  }
}
</script>
<style scoped>
  .goods-img{
    width: 106.6px;
    height: 60px;
    margin-right: 10px;
  }
</style>
