
<template>
  <div class="upload-container">
    <ul>
      <li class="zip-list-li" v-for="(row, index) in clouds" :key="'zip-' + index">
        <div class="flex flex-center-v">
          <img class="margin-r-8" src="/img/icons/icon-zip.svg"/>
          <h5>{{ row.fname }} </h5>
          <i @click="handleRemove(row)" class="el-icon-delete"></i>
        </div>
        <el-input v-if="hasDesc" class="margin-t-10" v-model="row.description" placeholder="请填写附件描述内容"></el-input>
      </li>
    </ul>
    <div class="bg-gay flex flex-center-v">
      <el-upload
        :data="dataObj"
        :headers="headers"
        ref="upload"
        class="upload-zip-part"
        drag
        :action="uploadUrl"
        :multiple="false"
        :show-file-list="false"
        :on-success="handleSuccess"
        :on-error="handleError"
        :before-upload="beforeUpload"
        :limit="xyLimit"
        :on-exceed="handleExceed"
        :file-list="clouds"
        v-loading="loading"
      >
        <i class="el-icon-plus"></i>
        <div class="el-upload__text">上传附件</div>
      </el-upload>
      <div class="el-upload__tip">
        <h5>· 大小不能超过 {{ maxSize }}M</h5>
        <h5>· <template v-if="upType === 'zip'">附件为任何类型项目补充文档，</template>最多上传{{ xyLimit }}个</h5>
      </div>
    </div>
  </div>
</template>
<script>
  import { getToken } from '@/js/api/qiniu'
  import config from '@/js/utils/config'

  export default {
    props: {
      clouds: {
        type: Array,
        default: []
      },
      xyLimit: {
        type: Number,
        default: 3
      },
      maxSize: {
        type: Number,
        default: 10
      },
      hasDesc: {
        type: Boolean,
        default: false
      },
      storage: {
        type: String,
        default: 'qiniu'
      },
      upType: {
        type: String,
        default: 'zip'
      },
      upUrl: {
        type: String,
        default: ''
      },
      headers: {
        type: Object,
        default: function() {
          return { url: '' }
        }
      },
    },
    data() {
      return {
        loading: false,
        dataObj: { token: '' },
        uploadUrl: this.upUrl,
      };
    },
    created() {
      if (this.storage === 'qiniu') {
        this.uploadUrl = config.qiniu.uploadUrl
      } else if (this.storage === 'local') {
        this.headers['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content
        this.headers['X-Requested-With'] = 'XMLHttpRequest'
      }
    },
    methods: {
      handleExceed() {
        this.loading = false
        this.$message.warning(`最多上传${this.xyLimit}个`);
      },

      beforeUpload(file) {
        const checkSize = file.size < 1024 * 1024 * this.maxSize;
        if (!checkSize) {
          this.$message.error('上传附件大小不能超过 ' + this.maxSize + 'MB!');
          return false
        }
        const _self = this
        this.loading = true
        if (this.storage === 'qiniu') {
          return new Promise((resolve, reject) => {
            getToken('file').then(token => {
              _self.dataObj.token = token
              _self.dataObj['x:name'] = file.name
              resolve(true)
            }).catch(err => {
              reject(false)
            })
          })
        } else {
          return true
        }
      },
      handleSuccess(response, file, fileList){
        this.loading = false
        if (response.code === 200) {
          for (let index = 0; index < this.clouds.length; index++) {
            if (this.clouds[index].cloud_id == response.data.cloud_id) {
              this.$refs.upload.handleRemove(file)
              this.$message.error('请不要重复上传!');
              return false;
            }
          }
          const ret = {}
          ret.row_id = file.uid
          ret.cloud_id = response.data.cloud_id
          ret.fname = response.data.name
          ret.url = response.data.url
          this.clouds.push(ret)
        }
      },
      handleError(err, file, fileList){
        this.loading = false
        const data = JSON.parse(err.message)
        if (data) {
          this.$message.error(data.message)
          return
        }
        this.$message.error('上传出错了，请重试或联系管理员!');
      },
      handleRemove(file) {
        for (let index = 0; index < this.clouds.length; index++) {
          if (this.clouds[index].row_id == file.row_id) {
            this.clouds.splice(index, 1)
          }
        }
      }
    }
  }
</script>

<style lang="scss" scoped>
  .bg-gay{
    background: #fafafa;
    padding: 15px;;
  }
  .ellipsis{
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  
  .el-icon-plus{
    font-size:16px;
    font-weight: 800;
  }
  .upload-zip-part{
    ::v-deep .el-upload-dragger{
      display: flex;
      align-items: center;
      justify-content: center;
      padding-top: 0;
      height: 40px;
    }
  }
  .zip-list-li{
    padding-bottom: 10px;
    padding-top: 10px;
    h5{
      color:#222;
      font-size:16px;
      width: 93%;
      @extend .ellipsis;
      margin-bottom: 0;
    }
    [class^=el-icon-]{
      font-size: 16px;
    }
  }
  .zip-list-li:hover{
    color: #409eff;
  }
  .margin-t-10{
    margin-top:10px;
  }

</style>
