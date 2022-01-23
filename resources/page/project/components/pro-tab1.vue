<template>
  <div>
    <el-form v-loading="proLoading" :model="project" :rules="rules" ref="projectForm" label-width="100px" class="widthForm100 no-radius">
      <el-form-item label="标题" prop="title">
        <el-input v-model="project.title" placeholder="请填写标题"></el-input>
      </el-form-item>
      <el-form-item>
        <Upload v-model="project.cloud_id" :cloud="project.cloud" :crop-opt="imageOptions" />
      </el-form-item>
      <el-form-item label="摘要" prop="summary">
        <el-input type="textarea" :rows="2" placeholder="请填写摘要，字数在 30 ~ 120 之间" v-model="project.summary"></el-input>
      </el-form-item>
      <el-form-item label="视频代码" prop="video_code">
        <el-input v-model="project.video_code" placeholder="请填写视频代码"></el-input>
      </el-form-item>
      <el-form-item>
        <div class="upload-container flex flex-center-v">
          <div class="el-upload__tip error-icon-div">
            <h5 class="hasIcons"><img src="/img/icons/error-red.svg">注意事项：优酷、腾讯、B站等通用视频分享代码（iframe形式）</h5>
          </div>
        </div>
      </el-form-item>
      <el-form-item label="类型" prop="type">
        <el-select v-model="project.type">
          <el-option
            v-for="productType in projectCnf.type"
            :key="productType.k"
            :label="productType.l"
            :value="productType.k"
          />
        </el-select>
      </el-form-item>
      <el-form-item label="目标金额" prop="fund_goal" v-if="project.type != enums.project.type.share">
        <el-input v-model="project.fund_goal" placeholder="请填写众筹目标金额"></el-input>
      </el-form-item>
      <el-form-item label="活动时间段" prop="date" v-if="project.type == enums.project.type.activity">
        <el-date-picker
          v-model="project.date"
          type="datetimerange"
          range-separator="至"
          start-placeholder="开始时间"
          end-placeholder="结束时间"
          value-format="yyyy-MM-dd HH:mm:ss"
        />
      </el-form-item>
      <el-form-item label="标签" prop="tag_ids">
        <el-select
          style="width:100%;"
          v-model="project.tag_ids"
          multiple
          :multiple-limit="10"
          filterable
          allow-create
          reserve-keyword
          default-first-option
          remote
          :loading="tagLoading"
          :remote-method="getTagsList"
          @focus="focusTags"
          placeholder="请选择标签">
          <el-option
            v-for="item in tagOptions"
            :key="item.id"
            :label="item.name"
            :value="item.id">
          </el-option>
        </el-select>
      </el-form-item>
      <el-form-item v-if="isInited" label="高校" prop="college_id">
        <el-select v-model="project.college_id" filterable remote :remote-method="searchColleges" :loading="collegeLoading">
          <el-option
            label="请输入关键词（无）"
            :value="0"
          />
          <el-option
            v-for="college in colleges"
            :key="college.id"
            :label="college.name"
            :value="college.id"
          />
        </el-select>
      </el-form-item>
      <el-form-item label="团队介绍" prop="team_intro">
        <el-input type="textarea" :rows="3" placeholder="请输入团队介绍" v-model="project.team_intro"></el-input>
      </el-form-item>
      <el-form-item label="团队成员">
        <el-button plain icon="el-icon-circle-plus-outline" @click="handleAddTeam">添加成员</el-button>
        <div class="teamList">
          <ul>
            <li v-for="projectTeam in project.teams" :key="'team-' + projectTeam.id">
              <img class="avatar" :src="projectTeam.cloud.url" @click="handleEditTeam(projectTeam)"/>
              <div class="right-part flex flex-between flex-start-t">
                <div style="width:600px;" @click="handleEditTeam(projectTeam)">
                  <h6>{{ projectTeam.name }}</h6>
                  <p>{{ projectTeam.description }}</p>
                </div>
                <img class="pos-right" src="/img/icons/del-img.svg" @click.prevent="handleDelete(projectTeam)"/>
              </div>
            </li>
          </ul>
        </div>
      </el-form-item>
      <el-form-item v-if="isInited" label="描述" class="editor-container" prop="description">
        <div class="components-container">
          <tinymce v-model="project.description" :height="300" />
        </div>
      </el-form-item>
      <el-form-item v-if="isInited && userInfo.is_admin" label="规则" class="editor-container" prop="rule">
        <div class="components-container">
          <tinymce v-model="project.rule" :height="100" />
        </div>
      </el-form-item>
      <el-form-item label="参与推广" prop="promote">
        <el-switch v-model="project.promote" :inactive-value="0" :active-value="1"></el-switch>
        <span class="switch-tip">帮助推广平台产品，交易成功可获得 5% 推广费用</span>
      </el-form-item>
      <el-form-item v-if="userInfo.is_admin" label="支付协议">
        <el-switch v-model="project.has_agreement" :inactive-value="0" :active-value="1"></el-switch>
      </el-form-item>
      <el-form-item v-if="isInited && userInfo.is_admin && project.has_agreement" class="editor-container" prop="agreement">
        <div class="components-container">
          <tinymce v-model="project.agreement" mode="text" :height="100" />
        </div>
      </el-form-item>
      <el-row :gutter="20">
        <el-col :span="12" :offset="6" class="width100" >
          <el-button resetForm @click="submitForm()" v-loading="prjSaving">保存</el-button>
        </el-col>
      </el-row>
    </el-form>
    <el-dialog class="moveModal" :title="dialogType==='edit'?'编辑':'添加'" :visible.sync="dialogVisible" width="70%">
      <div class="step-form">
        <el-form :model="teamRow" :rules="teamUserType == 0 ? teamRules0 : teamRules1" ref="teamForm" label-width="85px" class="widthForm100 no-radius">
          <el-form-item label="成员类型">
            <el-radio @change="changeTeamUserType" v-model="teamUserType" :label="1">本站会员</el-radio>
            <el-radio @change="changeTeamUserType" v-model="teamUserType" :label="0">非本站会员</el-radio>
          </el-form-item>
          <template v-if="teamUserType == 1">
            <el-form-item label="成员" prop="user_id">
              <el-select
                v-model="teamRow.user_id"
                filterable
                remote
                :remote-method="findUsers"
                :loading="teamLoading"
                placeholder="输入昵称">
                <el-option
                  v-for="item in teamUsers"
                  :key="item.id"
                  :label="item.nickname"
                  :value="item.id">
                  <img v-if="item.avatar" class="select-avatar" :src="item.avatar">
                  {{ item.nickname }}
                </el-option>
              </el-select>
            </el-form-item>
          </template>
          <template v-else>
            <el-form-item label="头像" prop="cloud_id">
              <Upload v-model="teamRow.cloud_id" :cloud="teamRow.cloud" :crop-opt="imageOptionsTeam"/>
            </el-form-item>
            <el-form-item label="姓名" prop="name">
              <el-input v-model="teamRow.name" placeholder="请填写姓名"></el-input>
            </el-form-item>
            <el-form-item label="简介" prop="description">
              <el-input type="textarea" :rows="3" placeholder="请填写简介" v-model="teamRow.description"></el-input>
            </el-form-item>
          </template>
        </el-form>
      </div>
      <div slot="footer" class="dialog-footer">
        <el-button size="sm"  class="button-new" v-loading="saving" @click="saveTeam">保存</el-button>
      </div>
    </el-dialog>
  </div>
</template>
<script>
import { getColleges, getProject, addProject, updateProject, addTeam, updateTeam, deleteTeam } from '@/js/api/project'
import { findUsers } from '@/js/api/user'
import { findTags } from '@/js/api/common'
import { deepClone } from '@/js/utils'
import Upload from '@/js/components/Upload/Crop.vue'
import Tinymce from '@/js/components/Tinymce'
import enums from '@/js/utils/enums'

const defaultTeam = {
  user_id: 0,
  cloud_id: 0,
  cloud: {
    url: '',
  },
  name: '',
  description: '',
}

export default {
  components: { Upload,Tinymce },
  props: {
    projectCnf: {
      type: Object,
      default: function() {
        return {
          type: [],
        }
      }
    },
    userInfo: {
      type: Object,
      default: function() {
        return {
          is_admin: false,
        }
      }
    },
  },
  data() {
    var validateMoney = (rule, value, callback) => {
      if (!/^\d+(\.\d{1,2})?$/.test(value)) {
        callback(new Error('目标金额格式有误!'));
      } else if (value < 0) {
        callback(new Error('目标金额格式有误!'));
      } else {
        callback();
      }
    }
    return{
      enums,
      isInit: false,
      isInited: false,
      saving: false,
      imageOptions:{
        width: 640,
        height: 360,
        noCircle:true,
        isShowUpText:false,
        isShowRtext:true,
        rightText:['图片类型： .jpg, .jpeg, .gif, .png','图⽚⽐例最佳为16:9， 最⼩尺⼨为640*360'],
        imgDesc:'添加 / 更改封面',
        imgSize:'big'
      },
      imageOptionsTeam:{
        width: 300,
        height: 300,
        noCircle:true,
        isShowUpText:false,
        isShowRtext:false,
        imgDesc:'添加头像',
        imgSize:'small',
        style:'width:112px;height:112px;padding: 0;'
      },
      config: {
        initialFrameWidth: null,
        initialFrameHeight: 350,
      },
      initTagOptions: true,
      tagLoading:false,
      proLoading:false,
      prjSaving:false,
      tagOptions: [],
      project: {
        title: '',
        summary: '',
        video_code: '',
        cloud_id: 0,
        type: '',
        fund_goal: 0,
        tag_ids: [],
        college_id: 0,
        team_intro: '',
        teams: [],
        description: '',
        rule: '',
        promote: 0,
        has_agreement: 0,
        agreement: '',
      },
      colleges: [],
      collegeLoading: false,
      teamLoading: false,
      teamUserType: 1,
      teamUsers: [],
      rules: {
        title: [
          { required: true, message: '请输入名称', trigger: 'blur' }
        ],
        summary: [
          { required: true, message: '请填写摘要', trigger: 'blur' },
          { min: 30, max: 120, message: '摘要请控制在 30 到 120 字之间', trigger: 'blur' }
        ],
        type:[
          { required: true, message: '请选择项目类型', trigger: 'blur' }
        ],
        fund_goal: [
          { validator: validateMoney, trigger: 'blur' }
        ],
        tag_ids:[
          { required: true, message: '请选择标签', trigger: 'blur' }
        ],
        team_intro: [
          { max: 800, message: '团队介绍请不要超过800字', trigger: 'blur' }
        ],
        description:[
          { required: true, message: '请填写项目描述', trigger: 'blur' }
        ]
      },
      dialogType: 'new',
      dialogVisible: false,
      teamRow: Object.assign({}, defaultTeam),
      teamFlash: null,
      teamRules0: {
        cloud_id: [
          { required: true, message: '请上传图片', trigger: 'blur' }
        ],
        name: [
          { required: true, message: '请填写姓名', trigger: 'blur' }
        ],
        description:[
          { required: true, message: '请填写简介', trigger: 'blur' }
        ],
      },
      teamRules1: {
        user_id: [
          { required: true, message: '请选择成员', trigger: 'blur' }
        ],
      }
    }
  },
  created() {
    this.initTab()
  },
  methods:{
    async initTab() {
      if (!this.isInit) {
        this.isInit = true;
        const draftId = this.$route.params.id || null
        if (draftId) {
          await this.getProject(draftId)
        } else {
          await this.addProject()
        }
        await this.cnf()
        this.isInited = true
      }
    },
    async cnf() {
      const res = await getColleges({id: this.project.college_id})
      this.colleges = res.data
    },
    async searchColleges(q) {
      this.collegeLoading = true;
      const res = await getColleges({q})
      this.colleges = res.data
      this.collegeLoading = false;
    },
    async addProject() {
      const res = await addProject()
      this.project = res.data
      this.$router.push('/project/edit/' + res.data.id)
      this.$emit('freshProject')
    },
    async getProject(projectId) {
      this.proLoading = true
      const res = await getProject(projectId)
      this.project = res.data
      this.projectCnf.projectId = this.project.project_id
      if (!this.project.can_edit) {
        const _self = this
        this.$notify({
          title: '审核中',
          message: '项目正在审核中，无法修改',
          type: 'warning',
          onClose: function() {
            _self.$router.push('/project/list')
          }
        });
        return false;
      }
      if (this.project.tags.length > 0) {
        this.project.tags.forEach(tag => {
          let hasTag = false;
          for (let i = 0; i < this.tagOptions.length; i++) {
            if (tag.id === this.tagOptions[i].id) {
              hasTag = true;
              break;
            }
          }
          if (!hasTag) {
            this.tagOptions.push({
              id: tag.id,
              name: tag.name,
            })
          }
        })
      }
      this.proLoading = false
    },
    changeTeamUserType(type) {
      if (type == 0) {
        this.teamUsers = []
        this.teamRow.cloud_id = 0
        this.teamRow.cloud.url = ''
      } else {
        if (this.teamFlash) {
          this.teamUsers = [this.teamFlash]
          this.teamRow.cloud.url = this.teamFlash.avatar
        } else {
          this.teamUsers = []
        }
      }
      this.$refs['teamForm'].clearValidate()
    },
    async findUsers(query) {
      if (query !== '') {
          this.teamLoading = true;
          const res = await findUsers({q: query})
          this.teamLoading = false
          this.teamUsers = res.data
      } else {
        this.teamUsers = []
      }
    },
    handleAddTeam() {
      this.teamUsers = []
      this.teamFlash = null
      this.teamUserType = 1
      this.teamRow = deepClone(defaultTeam)
      this.teamRow.user_id = ''
      this.dialogType = 'new'
      this.dialogVisible = true
    },
    handleEditTeam(row) {
      this.teamUsers = []
      this.teamUserType = row.user_id > 0 ? 1 : 0
      this.teamRow = deepClone(row)
      if (row.user_id > 0) {
        this.teamFlash = {
          id: row.user_id,
          nickname: row.name,
          avatar: row.cloud.url,
        }
        this.teamUsers.push(this.teamFlash)
      } else {
        this.teamFlash = null
        this.teamRow.user_id = ''
      }

      this.dialogType = 'edit'
      this.dialogVisible = true
    },
    handleDelete(row) {
      this.$confirm('确定要删除吗', '警告', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
      })
        .then(async() => {
          await deleteTeam(row.id)
          for (let index = 0; index < this.project.teams.length; index++) {
            if (this.project.teams[index].id === row.id) {
              this.project.teams.splice(index, 1)
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
    saveTeam() {
      if (this.saving) {
        return
      }
      this.$refs['teamForm'].validate(async (valid) => {
        this.saving = true
        try {
          if (valid) {
            const isEdit = this.dialogType === 'edit'
            if (isEdit) {
              const { data } = await updateTeam(this.teamRow.id, this.teamFields(this.teamRow))
              this.teamRow = data
              for (let index = 0; index < this.project.teams.length; index++) {
                if (this.project.teams[index].id === this.teamRow.id) {
                  this.project.teams.splice(index, 1, Object.assign({}, this.teamRow))
                  break
                }
              }
            } else {
              const { data } = await addTeam(this.teamFields(this.teamRow))
              this.teamRow = data
              this.project.teams.push(this.teamRow)
            }

            this.dialogVisible = false
            this.$notify({
              title: 'Success',
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
    async getTagsList (query){
      this.initTagOptions = false;
      this.tagLoading = true;
      const res = await findTags(query);
      this.tagOptions = res.data
      this.tagLoading = false;
    },
    async focusTags(){
      if (this.initTagOptions || this.tagOptions.length === 0) {
        this.getTagsList('')
      }
    },
    fields(project) {
      return {
        title: project.title,
        summary: project.summary,
        video_code: project.video_code,
        cloud_id: project.cloud_id,
        type: project.type,
        fund_goal: project.fund_goal,
        start_at: project.date[0],
        end_at: project.date[1],
        tags: project.tag_ids,
        college_id: project.college_id,
        team_intro: project.team_intro,
        description: project.description,
        rule: project.rule,
        promote: project.promote,
        has_agreement: project.has_agreement,
        agreement: project.agreement,
      }
    },
    teamFields(team) {
      if (this.teamUserType == 0) {
        return {
          draft_id: this.project.id,
          cloud_id: team.cloud_id,
          name: team.name,
          description: team.description,
        }
      } else {
        return {
          draft_id: this.project.id,
          user_id: team.user_id,
        }
      }
    },
    submitForm(publish = false) {
      return new Promise(resolve => {
        this.$refs['projectForm'].validate(async (valid) => {
          this.prjSaving = true
          try {
            if (valid) {
              await updateProject(this.project.id, this.fields(this.project));
              if (publish) {
                this.prjSaving = false
                resolve(true)
                return
              }
              this.$notify({
                title: 'Success',
                message: '保存成功',
                type: 'success'
              })
            }else{
              this.$notify({
                title: 'Error',
                message: '保存有误，请检查并修改错误~',
                type: 'error'
              })
            }
            this.prjSaving = false
          } catch (error) {
            this.prjSaving = false
            throw error
          }
        })
      })
    }
  }
}
</script>
