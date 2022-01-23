<template>
  <div>
    <div class="pro-step-list">
      <ul v-loading="listLoading" :class="minHeight">
        <li class="flex flex-bottom-v flex-between" v-for="(row, index) in list" :key="'schedule' + row.id" @click="handleEdit(row, index, $event)">
          <div class="left-part">
            <el-tooltip content="编辑" placement="top" effect="light">
              <h6>{{ row.title }}</h6>
            </el-tooltip>
            <p>{{ stripTags(row.description) }}</p>
            <p>{{ row.submit_at }}</p>
          </div>
          <div class="pos-right" ><i class="el-icon-delete"></i></div>
        </li>
      </ul>
    </div>
    <div class="buttonFill flex flex-center" @click="handleAddSchedule">
      <i class="el-icon-circle-plus-outline margin-r-8"></i>添加项目进度
    </div>
    <el-dialog class="moveModal" :visible.sync="dialogVisible" :title="dialogType==='edit'?'编辑':'添加'" width="60%">
      <div class="step-form">
        <el-form :model="schedule" ref="scheduleForm" :rules="rules" label-width="85px" class="widthForm100 no-radius">
          <el-form-item label="标题" prop="title">
            <el-input v-model="schedule.title"></el-input>
          </el-form-item>
          <el-form-item label="视频代码" prop="video_code">
            <el-input v-model="schedule.video_code" placeholder="请填写视频代码"></el-input>
          </el-form-item>
          <el-form-item>
            <div class="upload-container flex flex-center-v">
              <div class="el-upload__tip error-icon-div">
                <h5 class="hasIcons"><img src="/img/icons/error-red.svg">注意事项：优酷、腾讯、B站等通用视频分享代码（iframe形式）</h5>
              </div>
            </div>
          </el-form-item>
          <el-form-item label="日期" prop="submit_at">
            <el-date-picker type="date" value-format="yyyy-MM-dd" placeholder="选择日期" v-model="schedule.submit_at"></el-date-picker>
          </el-form-item>
          <el-form-item label="描述" prop="description">
            <tinymce ref="scheduleEditor" v-model="schedule.description" :height="100" />
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
import Tinymce from '@/js/components/Tinymce'
import { getSchedules, addSchedule, updateSchedule, deleteSchedule } from '@/js/api/project'
import { deepClone, stripTags } from '@/js/utils'
const now = new Date()
const month = now.getMonth() + 1
const day = now.getDate()
const defaultSchedule = {
  title:'',
  video_code:'',
  submit_at: `${now.getFullYear()}-${month < 10 ? '0' + month : month}-${day < 10 ? '0' + day : day}`,
  description:'',
};
export default {
  components: { Tinymce },
  data () {
    return {
      isInit: false,
      saving: false,
      minHeight: 'minH100',
      listLoading: false,
      draftId: this.$route.params.id,
      list: [],
      dialogVisible: false,
      dialogType: 'new',
      schedule: Object.assign({}, defaultSchedule),
      rules: {
        title: [
          { required: true, message: '请输入标题', trigger: 'blur' }
        ],
        description:[
          { required: true, message: '请输入描述', trigger: 'blur' }
        ]
      }
    }
  },
  methods: {
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
      const res = await getSchedules({
        draft_id: this.draftId
      });
      if(res.data.length==0){
        this.minHeight = 'noHeight'
      }
      this.list = res.data
      this.listLoading = false
    },
    stripTags(html) {
      return stripTags(html)
    },
    handleAddSchedule() {
      this.schedule = Object.assign({}, defaultSchedule)
      if (this.$refs.scheduleEditor)
        this.$refs.scheduleEditor.setContent('')
      this.dialogType = 'new'
      this.dialogVisible = true
    },
    handleEdit(row, index, event) {
      if (event.target.className == 'el-icon-delete') {
        this.handleDelete(row, index)
      } else {
        if (this.$refs.scheduleEditor)
          this.$refs.scheduleEditor.setContent(row.description)
        this.dialogType = 'edit'
        this.dialogVisible = true
        this.schedule = deepClone(row)
      }
    },
    handleDelete(row, index) {
      this.$confirm('确定要删除吗', '警告', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
      })
        .then(async() => {
          await deleteSchedule(row.id)
          this.list.splice(index, 1)
          this.$notify({
            title: 'Success',
            message: '操作成功',
            type: 'success'
          })
        })
        .catch(err => {})
    },
    fields(schedule) {
      return {
        draft_id: this.draftId,
        title: schedule.title,
        video_code: schedule.video_code,
        submit_at: schedule.submit_at,
        description: schedule.description
      }
    },
    async confirmSubmit() {
      if (this.saving) {
        return
      }
      this.$refs['scheduleForm'].validate(async (valid) => {
        this.saving = true
        try {
          if (valid) {
            const isEdit = this.dialogType === 'edit'
            if (isEdit) {
              await updateSchedule(this.schedule.id, this.fields(this.schedule))
              for (let index = 0; index < this.list.length; index++) {
                if (this.list[index].id === this.schedule.id) {
                  this.list.splice(index, 1, Object.assign({}, this.schedule))
                  break
                }
              }
            } else {
              const { data } = await addSchedule(this.fields(this.schedule))
              this.schedule.id = data.id
              this.list.push(this.schedule)
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
<style lang="scss">
  .minH100{
    min-height:100px;
  }
  .noHeight{
    min-height:0;
  }
</style>
  