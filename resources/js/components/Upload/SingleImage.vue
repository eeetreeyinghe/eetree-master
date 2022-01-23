<template>
  <!--基本信息的图片上传  -->
  <div class="upload-container-div " :style="options.style" :class="options.imgSize">
    <div class="flex flex-center-v" :class="options.imgSize=='small' ? 'width100': ''">
      <el-upload
        :data="dataObj"
        :show-file-list="false"
        class="upload-part flex flex-center-v"
        :class="options.imgRadius ? 'radius': ''"
        drag
        :action="uploadUrl"
        :on-preview="handlePictureCardPreview"
        :on-success="handleImageSuccess"
        :on-error="handleImageError"
        :before-upload="beforeUpload"
        v-loading="loadingUpload"
        multiple>
        <i class="el-icon-plus"></i>
        <div class="el-upload__text" v-if="options.imgDesc" v-text="options.imgDesc"></div>
        <img :src="cloud.url" class="current-preview" v-show="cloud.url.length>1">
      </el-upload>
      <div class="el-upload__tip" v-if="options.isShowRtext">
        <h5 v-for="(text,index ) in options.rightText" :key="index">
          {{text}}
        </h5>
      </div>
    </div>
  </div>
</template>

<script>
import { getToken } from '@/js/api/qiniu'
import config from '@/js/utils/config'

export default {
  name: 'SingleImageUpload',
  props: {
    cloud: {
      type: Object,
      default: function() {
        return { url: '' }
      }
    },
    value: {
      type: Number,
      default: 0
    },
    options:{
      type: Object,
      default: function() {
        return { 
          isShowRtext:false,
          rightText:[''],
          imgDesc:'',
          style:''
        }
      }
    },
  },
  data() {
    return {
      cloud_id: 0,
      loadingUpload:false,
      dataObj: { token: '' },
      uploadUrl: config.qiniu.uploadUrl,
    }
  },
  methods: {
    handleImageError(err){
      this.loadingUpload = false
      this.$message.error('上传出错了，请重试或联系管理员!');
    },
    handleImageSuccess(response) {
      this.loadingUpload = false
      this.cloud.url = response.data.url
      this.$emit('input', response.data.cloud_id)
    },
    handlePictureCardPreview(file) {
      this.dialogImageUrl = file.url;
      this.dialogVisible = true;
    },
    beforeUpload(file) {
      const isLt1M = file.size < 1024 * 1024;
      if (!isLt1M) {
        this.$message.error('上传图片大小不能超过 1MB!');
        return false
      }
      const _self = this
      this.loadingUpload = true
      return new Promise((resolve, reject) => {
        getToken().then(token => {
          _self.dataObj.token = token
          _self.dataObj['x:name'] = file.name
          resolve(true)
        }).catch((err) => {
          reject(false)
        })
      })
    }
  }
}
</script>

<style lang="scss" scoped>
  .el-icon-plus{
    font-size:20px;
    font-weight: 800;
  }
  .width100{
    width: 100%;
    height: 100%;
  }
  .current-preview{
    position: absolute;
    @extend .width100;
    left:0;
    top:0;
  }
  .upload-container-div{
    background: unset;
  }
  .upload-container-div .upload-part{
    background: #fafafa;
  }
  .upload-container-div .upload-part.radius{
    border-radius: 50%;
  }

</style>
<style scoped>
  .upload-container-div.big >>> .el-upload-dragger{
    width: 270px;
    height: 150px;
  }
  .upload-container-div.small >>> .el-upload,
  .upload-container-div.small >>> .upload-part,
  .upload-container-div.small >>> .el-upload-dragger{
    width: 100%;
    height: 100%;
  }
  .upload-container-div >>> .el-upload-dragger{
    line-height: 2.5;
  }
  .upload-part.radius >>> .el-upload-dragger{
    border-radius: 50%;
  }
  
</style>
