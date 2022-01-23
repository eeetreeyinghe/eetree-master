<template>
  <div>
    <div class="pro-step-list">
      <ul v-loading="listLoading" :class="minHeight">
        <li class="flex flex-bottom-v flex-between" v-for="(row, index) in list" :key="'course' + row.id" @click="handleEdit(row, index, $event)">
          <div class="left-part flex flex-center-v">
            <img class="course-img" :src="row.cloud.url"/>
            <div>
              <h6>{{ row.title }}</h6>
              <p>{{ row.description }}</p>
            </div>
          </div>
          <img class="pos-right" src="/img/icons/del-img.svg"/>
        </li>
      </ul>
    </div>
    <div class="buttonFill flex flex-center" @click="handleAddCourse">
      <i class="el-icon-circle-plus-outline margin-r-8"></i> 添加课程
    </div>
    <el-dialog class="moveModal" :visible.sync="dialogVisible" :title="dialogType==='edit'?'编辑':'添加'" width="70%">
      <div class="step-form">
        <el-form ref="courseForm" :model="xcourse" :rules="rules" label-width="85px" class="widthForm100 no-radius">
          <el-form-item label="课程图片" prop="cloud_id">
            <Upload v-model="xcourse.cloud_id" :cloud="xcourse.cloud" :crop-opt="imageOptionsCourse"/>
          </el-form-item>
          <el-form-item label="名称" prop="title">
            <el-input v-model="xcourse.title" placeholder="请填写标题"></el-input>
          </el-form-item>
          <el-form-item label="链接" prop="link">
            <el-input v-model="xcourse.link" placeholder="请填写链接"></el-input>
          </el-form-item>
          <el-form-item label="描述" prop="description">
            <el-input type="textarea" :rows="3" placeholder="请输入课程介绍" v-model="xcourse.description"></el-input>
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
import { getCourse, addCourse, updateCourse, deleteCourse } from '@/js/api/project'
import { deepClone, checkCloud } from '@/js/utils'
const defaultCourse = {
  cloud_id: 0,
  cloud: {
    url: '',
  },
  title:'',
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
      xcourse: Object.assign({}, defaultCourse),
      imageOptionsCourse:{
        width: 480,
        height: 270,
        noCircle:true,
        isShowUpText:false,
        isShowRtext:false,
        imgDesc:'课程图片',
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
      const res = await getCourse({
        draft_id: this.draftId
      });
      if(res.data.length==0){
        this.minHeight = 'noHeight'
      }
      this.list = res.data
      this.listLoading = false
    },
    handleAddCourse() {
      this.xcourse = deepClone(defaultCourse)
      this.dialogType = 'new'
      this.dialogVisible = true
    },
    handleEdit(row, index, event) {
      if (event.target.className == 'pos-right') {
        this.handleDelete(row, index)
      } else {
        this.dialogType = 'edit'
        this.dialogVisible = true
        this.xcourse = deepClone(row)
      }
    },
    handleDelete(row, index) {
      this.$confirm('确定要删除吗', '警告', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
      })
        .then(async() => {
          await deleteCourse(row.id)
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
    fields(xcourse) {
      return {
        draft_id: this.draftId,
        cloud_id: xcourse.cloud_id,
        title: xcourse.title,
        link: xcourse.link,
        description: xcourse.description
      }
    },
    async confirmSubmit() {
      if (this.saving) {
        return
      }
      this.$refs['courseForm'].validate(async (valid) => {
        this.saving = true
        try {
          if (valid) {
            const isEdit = this.dialogType === 'edit'
            if (isEdit) {
              await updateCourse(this.xcourse.id, this.fields(this.xcourse))
              for (let index = 0; index < this.list.length; index++) {
                if (this.list[index].id === this.xcourse.id) {
                  this.list.splice(index, 1, Object.assign({}, this.xcourse))
                  break
                }
              }
            } else {
              const { data } = await addCourse(this.fields(this.xcourse))
              this.xcourse.id = data.id
              this.list.push(this.xcourse)
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
  .course-img{
    width: 106.6px;
    height: 60px;
    margin-right: 10px;
  }
</style>
