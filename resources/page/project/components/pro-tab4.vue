<template>
  <div>
    <div class="pro-step-list">
      <draggable
        element="ul"
        v-loading="listLoading"
        :class="minHeight"
        v-model="list"
        group="caseorder"
        @end="dragOrder"
      >
        <transition-group>
          <li class="flex flex-bottom-v flex-between" v-for="(row, index) in list" :key="'case' + row.id" @click="handleEdit(row, index, $event)">
            <div class="left-part flex flex-center-v">
              <img class="case-img" :src="row.cloud.url"/>
              <div>
                <h6>{{ row.title }}</h6>
                <p>{{ row.description }}</p>
              </div>
            </div>
            <img class="pos-right" src="/img/icons/del-img.svg"/>
          </li>
        </transition-group>
      </draggable>
    </div>
    <div class="buttonFill flex flex-center" @click="handleAddCase">
      <i class="el-icon-circle-plus-outline margin-r-8"></i> 添加案例
    </div>
    <el-dialog class="moveModal" :visible.sync="dialogVisible" :title="dialogType==='edit'?'编辑':'添加'" width="70%">
      <div class="step-form">
        <el-form ref="caseForm" :model="xcase" :rules="rules" label-width="85px" class="widthForm100 no-radius">
          <el-form-item label="案例图片" prop="cloud_id">
            <Upload v-model="xcase.cloud_id" :cloud="xcase.cloud" :crop-opt="imageOptionsCase"/>
          </el-form-item>
          <el-form-item label="名称" prop="title">
            <el-input v-model="xcase.title" placeholder="请填写标题"></el-input>
          </el-form-item>
          <el-form-item label="链接" prop="link">
            <el-input v-model="xcase.link" placeholder="请填写链接"></el-input>
          </el-form-item>
          <el-form-item label="描述" prop="description">
            <el-input type="textarea" :rows="3" placeholder="请输入案例介绍" v-model="xcase.description"></el-input>
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
import draggable from 'vuedraggable'
import { getCase, addCase, updateCase, deleteCase, moveCase } from '@/js/api/project'
import { deepClone, checkCloud } from '@/js/utils'
const defaultCase = {
  cloud_id: 0,
  cloud: {
    url: '',
  },
  title:'',
  link: '',
  description:'',
};
export default {
  components: { Upload, draggable },
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
      xcase: Object.assign({}, defaultCase),
      imageOptionsCase:{
        width: 480,
        height: 270,
        noCircle:true,
        isShowUpText:false,
        isShowRtext:false,
        imgDesc:'案例图片',
        imgSize:'small',
        style:'width:240px;height:136px;padding: 0;'
      },
      rules: {
        cloud_id: [
          { required: true, message: '请上传图片', trigger: 'blur' },
          { validator: checkCloud, trigger: 'blur' }
        ],
        title: [
          { required: true, message: '请填写名称', trigger: 'blur' }
        ],
        link: [
          { required: true, message: '请填写链接', trigger: 'blur' },
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
        this.getList()
        this.isInit = true;
      }
    },
    async getList() {
      this.listLoading = true;
      const res = await getCase({
        draft_id: this.draftId
      });
      if(res.data.length==0){
        this.minHeight = 'noHeight'
      }
      this.list = res.data
      this.listLoading = false
    },
    handleAddCase() {
      this.xcase = deepClone(defaultCase)
      this.dialogType = 'new'
      this.dialogVisible = true
    },
    handleEdit(row, index, event) {
      if (event.target.className == 'pos-right') {
        this.handleDelete(row, index)
      } else {
        this.dialogType = 'edit'
        this.dialogVisible = true
        this.xcase = deepClone(row)
      }
    },
    handleDelete(row, index) {
      this.$confirm('确定要删除吗', '警告', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
      })
        .then(async() => {
          await deleteCase(row.id)
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
    fields(xcase) {
      return {
        draft_id: this.draftId,
        cloud_id: xcase.cloud_id,
        title: xcase.title,
        link: xcase.link,
        description: xcase.description
      }
    },
    async confirmSubmit() {
      if (this.saving) {
        return
      }
      this.$refs['caseForm'].validate(async (valid) => {
        this.saving = true
        try {
          if (valid) {
            const isEdit = this.dialogType === 'edit'
            if (isEdit) {
              await updateCase(this.xcase.id, this.fields(this.xcase))
              for (let index = 0; index < this.list.length; index++) {
                if (this.list[index].id === this.xcase.id) {
                  this.list.splice(index, 1, Object.assign({}, this.xcase))
                  break
                }
              }
            } else {
              const { data } = await addCase(this.fields(this.xcase))
              this.xcase.id = data.id
              this.list.unshift(this.xcase)
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
    },
    async dragOrder(e) {
      if (e.oldIndex != e.newIndex) {
        await moveCase(this.list[e.newIndex].id, {
          order: e.newIndex + 1
        })
      }
    }
  }
}
</script>
<style scoped>
  .case-img{
    width: 106.6px;
    height: 60px;
    margin-right: 10px;
  }
</style>
