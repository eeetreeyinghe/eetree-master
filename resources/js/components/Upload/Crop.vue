<template>
  <div class="upload-container" :style="cropOpt.style" :class="cropOpt.imgSize">
    <image-cropper
      v-show="imagecropperShow"
      :key="imagecropperKey"
      :width="cropOpt.width"
      :height="cropOpt.height"
      :no-circle="cropOpt.noCircle"
      :url="cropOpt.url"
      :storage="cropOpt.storage"
      :params="params"
      field="file"
      lang-type="zh"
      @close="close"
      @crop-upload-success="cropSuccess"
    />
    <div :class="cropOpt.noCircle? 'image-preview-nocircle':'image-preview'" class="pointer" @click="imagecropperShow=true">
      <i class="el-icon-plus"></i>
      <div class="el-upload__text" v-if="cropOpt.imgDesc" v-text="cropOpt.imgDesc"></div>
      <div v-show="cloud.url && cloud.url.length > 1" class="image-preview-wrapper">
        <img :src="cloud.url">
      </div>
    </div>
    <div class="el-upload__tip" v-if="cropOpt.isShowRtext">
      <h5 v-for="(text,index ) in cropOpt.rightText" :key="index">
        {{text}}
      </h5>
    </div>

    <div v-show="cropOpt.isShowUpText" class="hover-text font16 text-center pointer" @click="imagecropperShow=true">上传</div>
  </div>
</template>

<script>
import { getToken } from '@/js/api/qiniu'
import ImageCropper from '@/js/components/ImageCropper'

const defaultCropOpt = {
  width: 300,
  height: 300,
  noCircle: false,
  url: 'https://up-z2.qiniup.com',
  storage: 'qiniu'
}

export default {
  name: 'CropUpload',
  components: { ImageCropper },
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
    // 剪裁图片的宽
    cropOpt: {
      type: Object,
      'default': defaultCropOpt
    }
  },
  data() {
    return {
      params: {},
      imagecropperShow: false,
      imagecropperKey: 0
    }
  },
  created() {
    for (const i in defaultCropOpt) {
      if (!this.cropOpt[i]) {
        this.cropOpt[i] = defaultCropOpt[i]
      }
    }
    if (this.cropOpt.storage == 'qiniu') {
      this.getToken()
    }
  },
  methods: {
    async getToken() {
      this.params.token = await getToken()
    },
    cropSuccess(resData) {
      this.imagecropperShow = false
      this.imagecropperKey = this.imagecropperKey + 1
      this.cloud.url = resData.url
      if (this.cropOpt.storage == 'qiniu') {
        this.$emit('input', resData.cloud_id)
      }
    },
    close() {
      this.imagecropperShow = false
    }
  }
}
</script>

<style lang="scss" scoped>
  .upload-container {
    width: 100%;
    position: relative;
      
      
    .image-preview-nocircle,
    .image-preview {
      margin-top: 5px;
      margin-bottom: 10px;
      position: relative;
      .image-preview-action {
          position: absolute;
          width: 100%;
          height: 100%;
          left: 0;
          top: 0;
          cursor: default;
          text-align: center;
          color: #fff;
          opacity: 0;
          font-size: 20px;
          background-color: rgba(0, 0, 0, .5);
          transition: opacity .3s;
          cursor: pointer;
          text-align: center;
          line-height: 200px;
          .el-icon-delete {
              font-size: 36px;
          }
      }
      &:hover {
          .image-preview-action {
              opacity: 1;
          }
      }
    }
    // 方框带边框
    .image-preview-nocircle {
      position: relative;
      border-radius: 0;
      background: white;
      border: 1px solid #409eff;
      padding-top: 7%;
      color: #409EFF;
      text-align: center;
      font-size: 14px;
     
      display: inline-block;
      vertical-align: middle;
      .image-preview-wrapper {
        position: absolute;
        width:100%;
        height:100%;
        top:0;
        left:0;
        img {
          height:100%;
        }
      }
    }
    .el-upload__tip{
      display: inline-block;
      vertical-align: middle;
    }
    
    // 圆形头像
    .image-preview {
      width: 105px;
      height: 105px;
      border-radius: 50%;
      border: 1px solid #d4d4d4;
      .image-preview-wrapper {
          position: relative;
          width: 100%;
          height: 100%;
          border-radius: 50%;
          border: 6px solid #fff;
          img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
          }
      }
    }
    .image-preview-nocircle{
      .el-icon-plus{
        font-size:20px;
        font-weight: 800;
      }
    }
  }
  .width100{
    width: 100%;
    height: 100%;
  }
</style>
<style scoped>
  .upload-container.big >>> .el-upload-dragger{
    width: 270px;
    height: 150px;
  }
  .upload-container.small >>> .el-upload,
  .upload-container.small >>> .upload-part,
  .upload-container.small >>> .el-upload-dragger{
    width: 100%;
    height: 100%;
  }
  .upload-container.big >>>.image-preview-nocircle{
    width: 265px;
    height: 150px;
  }
  .upload-container.small >>>.image-preview-nocircle {
    width: 100%;
    height: 100%;
  }
  .upload-container >>> .el-upload-dragger{
    line-height: 2.5;
  }
  .upload-part.radius >>> .el-upload-dragger{
    border-radius: 50%;
  }
  
</style>

