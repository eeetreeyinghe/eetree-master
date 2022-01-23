<template>
  <div class="upload-container">
    <!-- :no-circle="cropOpt.noCircle" -->
    <image-cropper
      v-show="imagecropperShow"
      :key="imagecropperKey"
      :width="cropOpt.width"
      :height="cropOpt.height"
      :no-square="cropOpt.noCircle"
      :url="cropOpt.url"
      :storage="cropOpt.storage"
      :params="params"
      field="avatar"
      lang-type="zh"
      @close="close"
      @crop-upload-success="cropSuccess"
    />
    <div class="image-preview pointer" @click="imagecropperShow=true">
      <div v-show="cloud.url && cloud.url.length > 1" class="image-preview-wrapper">
        <img :src="cloud.url">
      </div>
    </div>
    <div class="hover-text font16 text-center pointer" @click="imagecropperShow=true">上传头像</div>
  </div>
</template>

<script>
import { getToken } from '@/js/api/qiniu'
import ImageCropper from '@/js/components/ImageCropper'

const defaultCropOpt = {
  width: 300,
  height: 300,
  noCircle: true,
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
        .image-preview {
            width: 105px;
            height: 105px;
            margin-top: 5px;
            border-radius: 50%;
            margin-bottom: 10px;
            position: relative;
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
    }

</style>
