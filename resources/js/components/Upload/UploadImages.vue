<template>
  <div class="upload-container-div">
    <div class="flex flex-center-v">
      <el-upload
        :data="dataObj"
        ref="upload"
        :multiple="false"
        :show-file-list="false"
        v-loading="loadingUpload"
        drag
        class="upload-part"
        :action="uploadUrl"
        :on-success="handleImageSuccess"
        :on-error="handleError"
        :before-upload="beforeUpload"
        :limit="xyLimit"
        :on-exceed="handleExceed"
        list-type="picture"
        accept="image/*"
        :file-list="clouds"
      >
        <i class="el-icon-plus"></i>
        <div class="el-upload__text">上传图片</div>
        <!-- <img :src="currentImageUrl" class="current-preview" v-show="currentImageUrl.length>1"> -->
      </el-upload>
      <div class="el-upload__tip">
        <h5>图片类型： .jpg, .jpeg, .gif, .png, .svg</h5>
        <h5>图片大小：不超过 1M, gif 不超过 5M</h5>
        <h5 v-if="limitText != ''">图片数量：{{ limitText }}</h5>
        <h5 v-else>图片数量：最多可上传{{ xyLimit }}张</h5>
      </div>
    </div>

    <ul class="el-upload-list el-upload-list--picture">
      <li class="el-upload-list__item is-success" :key="file.row_id" v-for="file in clouds">
        <img class="el-upload-list__item-thumbnail" :src="file.url" />
        <span class="el-upload-list">
          <span class="el-upload-list__item-preview margin-r-8" @click="handlePictureCardPreview(file)">
            <i class="el-icon-zoom-in"></i>
          </span>
          <span @click="handleRemove(file)">
            <i class="el-icon-delete"></i>
          </span>
        </span>
      </li>
    </ul>
    <!-- 图片预览 -->
    <el-dialog :visible.sync="dialogVisible">
      <img width="100%" :src="dialogImageUrl" alt="">
    </el-dialog>
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
      limitText: {
        type: String,
        default: ''
      }
    },
    data() {
      return {
        dataObj: { token: '' },
        uploadUrl: config.qiniu.uploadUrl,
        dialogImageUrl: '',
        currentImageUrl:'',
        dialogVisible: false,
        loadingUpload:false,
      };
    },
    methods: {
      handleExceed() {
        this.$message.warning(`最多上传${this.xyLimit}张`);
      },
      beforeUpload(file) {
        const isGIF = file.type === 'image/gif';
        let limitSize = isGIF ? 5 : 1;

        // if (!isJPG) {
        //   this.$message.error('上传头像图片只能是 JPG 格式!');
        // }
        if (file.size > limitSize * 1024 * 1024) {
          this.$message.error(`上传图片大小不能超过 ${limitSize}MB!`);
          return false
        }
        this.loadingUpload = true
        const _self = this
        return new Promise((resolve, reject) => {
          getToken().then(token => {
            _self.dataObj.token = token
            _self.dataObj['x:name'] = file.name
            resolve(true)
          }).catch(err => {
            reject(false)
          })
        })
      },
      handleImageSuccess(response, file, fileList) {
        this.loadingUpload = false;
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
          ret.hasSuccess = true
          this.currentImageUrl = response.data.url
          this.clouds.push(ret)
          this.$emit('on-success', ret, this.clouds)
        }
      },
      handleError(err, file, fileList){
        this.loadingUpload = false;
        this.$message.error('上传出错了，请重试或联系管理员!');
      },
      handleRemove(file) {
        for (let index = 0; index < this.clouds.length; index++) {
          if (this.clouds[index].row_id == file.row_id) {
            this.clouds.splice(index, 1)
            // this.$emit('on-change', this.clouds)
          }
        }
      },
      handlePictureCardPreview(file) {
        this.dialogImageUrl = file.url;
        this.dialogVisible = true;
      }
    }
  }
</script>

<style lang="scss" scoped>
  
  .el-icon-plus{
    font-size:20px;
    font-weight: 800;
  }
  .el-upload__tip{
    width: 57%;
    float: right;
    margin-top:0;
  }
  ::v-deep .el-upload-list{
    border-top: 1px solid #eee;
    display: flex;
  }

  ::v-deep .el-upload-list__item{
    width:140px;
    height:78.75px;
    padding: 0;
    border-radius: 0;
    margin-right: 10px;
    .el-upload-list__item-thumbnail{
      max-width:100%;
      max-height:100%;
      width: auto;
      height:auto;
      margin:0 auto;
      display: block;
      float: unset;
    }
    .el-upload-list{
      display: none;
      position: absolute;
      left: 0;
      top: 0;
      z-index: 2;
      width: 100%;
      height:75px;
      background: rgb(62 62 62 / 51%);
      color: #fff;
    }
  }
  ::v-deep .el-upload-list__item:hover {
    .el-upload-list{
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
    }
  }
  .current-preview{
    position: absolute;
    width:100%;
    height:100%;
    left:0;
    top:0;
  }
 

</style>
