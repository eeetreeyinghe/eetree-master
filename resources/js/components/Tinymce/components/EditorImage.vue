<template>
  <div class="upload-container">
    <el-button :style="{background:color,borderColor:color}" icon="el-icon-upload" size="mini" type="primary" @click="openUpload">
      上传
    </el-button>
    <el-dialog :visible.sync="dialogVisible">
      <upload-images :clouds="listObj" limitText="可同时上传3张"/>

      <el-button @click="dialogVisible = false">
        取消
      </el-button>
      <el-button type="primary" @click="handleSubmit">
        确定
      </el-button>
    </el-dialog>
  </div>
</template>

<script>
import { getToken } from '@/js/api/qiniu'
import config from '@/js/utils/config'
import UploadImages from '@/js/components/Upload/UploadImages.vue'

export default {
  name: 'EditorSlideUpload',
  components: { UploadImages },
  props: {
    color: {
      type: String,
      default: '#1890ff'
    }
  },
  data() {
    return {
      dialogVisible: false,
      dataObj: { token: '' },
      listObj: [],
      uploadUrl: config.qiniu.uploadUrl,
    }
  },
  methods: {
    openUpload() {
      this.dialogVisible = true
      this.listObj = []
    },
    handleSubmit() {
      this.$emit('successCBK', this.listObj)
      this.dialogVisible = false
    },
  }
}
</script>

<style lang="scss" scoped>
.editor-slide-upload {
  margin-bottom: 20px;
  ::v-deep .el-upload--picture-card {
    width: 100%;
  }
}
</style>
