<template>
  <el-form label-width="100px" class="demo-softForm margin-t-15" v-loading="getApiloading">
    <el-form-item class="border-b" :label="productType.l" :key="productType.k" v-for="productType in productTypes">
      <FindProducts :propData="productType" @on-change="changeProducts" />
    </el-form-item>
    <el-form-item label="平台">
      <RelateProject ref="refRelates" :project-id="projectCnf.projectId" @on-change="changeRelateProjects" />
    </el-form-item>
    <el-form-item :label="projectCnf.cloudTypes.DIAGRAM.l">
      <upload-images :clouds="clouds.DIAGRAM" />
    </el-form-item>
    <el-form-item v-if="userInfo.is_admin" :label="projectCnf.cloudTypes.HTML.l">
      <single-file ref="refHtml" :clouds="clouds.HTML" storage="local" :xy-limit="1" up-type="html" up-url="/upload/html"/>
    </el-form-item>
    <el-form-item :label="projectCnf.cloudTypes.ATTACHMENT.l">
      <single-file ref="refZip" :clouds="clouds.ATTACHMENT" :has-desc="true"/>
    </el-form-item>
    <el-row :gutter="20">
      <el-col :span="12" :offset="6" class="width100" >
        <el-button resetForm  v-loading="subloading" @click="submitForm()">保存</el-button>
      </el-col>
    </el-row>
  </el-form>
</template>
<script>

import UploadImages from '@/js/components/Upload/UploadImages.vue'
import SingleFile from '@/js/components/Upload/SingleFile.vue'
import { FindProducts } from '@/js/components/FindProducts'
import RelateProject from './RelateProject'
import { getEnums } from '@/js/api/common'
import { getProducts, updateProjectProducts, getClouds, updateProjectClouds, getRelates, updateProjectRelates } from '@/js/api/project'

export default {
  components: { UploadImages, FindProducts, SingleFile, RelateProject },
  props: {
    projectCnf: {
      type: Object,
      default: function() {
        return {
          projectId: 0,
          cloudTypes: {
            DIAGRAM: { k:-1, l:''},
            ATTACHMENT: { k:-1, l:''},
            HTML: { k:-1, l:''}
          },
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
  data () {
    return {
      isInit: false,
      subloading:false,
      draftId: this.$route.params.id,
      productTypes: [],
      relates: [],
      clouds: {
        DIAGRAM: [],
        ATTACHMENT: [],
        HTML: [],
      },
      getApiloading: false,
    }
  },
  methods:{
    async initTab() {
      if (!this.draftId) {
        this.draftId = this.$route.params.id
      }
      if (!this.isInit) {
        this.isInit = true;
        this.getProductTypes().then(ret => {
          this.getProducts()
          this.getRelates()
          this.getClouds()
        })
      }
    },
    async getProductTypes() {
      this.getApiloading = true
      const res = await getEnums('product.types', 'all')
      this.getApiloading = false
      for (let i in res.data) {
        this.productTypes[res.data[i].k] = res.data[i];
        this.productTypes[res.data[i].k].products = [];
      }
    },
    async getRelates() {
      const res = await getRelates({
        draft_id: this.draftId
      })
      this.relates = res.data
      this.$refs.refRelates.refresh(res.data)
    },
    async getProducts() {
      const res = await getProducts({
        draft_id: this.draftId
      })
      res.data.forEach(element => {
        this.productTypes[element.type].products.push(element)
      })
    },
    async getClouds() {
      const res = await getClouds({
        draft_id: this.draftId,
        group: true,
      })
      res.data.forEach(element => {
        if (element.type === this.projectCnf.cloudTypes.DIAGRAM.k) {
          this.clouds.DIAGRAM.push({
            row_id: element.id,
            cloud_id: element.cloud_id,
            fname: element.cloud.fname,
            url: element.cloud.url,
          })
        } else if (element.type === this.projectCnf.cloudTypes.ATTACHMENT.k) {
          this.clouds.ATTACHMENT.push({
            row_id: element.id,
            cloud_id: element.cloud_id,
            fname: element.cloud.fname,
            url: element.cloud.url,
            description: element.description,
          })
        } else if (element.type === this.projectCnf.cloudTypes.HTML.k) {
          this.clouds.HTML.push({
            row_id: element.id,
            cloud_id: element.cloud_id,
            fname: element.cloud.fname,
            url: element.cloud.url,
          })
        }
      })
    },
    changeProducts({type, products}) {
      this.productTypes[type].products = products
    },
    changeRelateProjects(projects) {
      this.relates = projects
    },
    async submitForm(publish = false) {
      return new Promise(async resolve => {
        if(this.subloading){
          return false
        }
        this.subloading = true
        const productIds = []
        const vProducts = []
        const saveClouds = []
        const relateIds = this.relates.map(r => r.id)
        this.productTypes.forEach(element => {
          element.products.forEach(product => {
            if (typeof product.id === 'number') {
              productIds.push(product.id)
            } else {
              vProducts.push(product)
            }
          })
        })
        this.clouds.DIAGRAM.forEach(element => {
          saveClouds.push({
            id: element.cloud_id,
            type: this.projectCnf.cloudTypes.DIAGRAM.k,
          })
        });
        this.clouds.ATTACHMENT.forEach(element => {
          saveClouds.push({
            id: element.cloud_id,
            type: this.projectCnf.cloudTypes.ATTACHMENT.k,
            description: element.description,
          })
        });
        this.clouds.HTML.forEach(element => {
          saveClouds.push({
            id: element.cloud_id,
            type: this.projectCnf.cloudTypes.HTML.k,
          })
        });
        await Promise.all([
          updateProjectProducts(this.draftId, {
            products: productIds,
            vProducts
          }),
          updateProjectRelates(this.draftId, {
            relates: relateIds,
          }),
          updateProjectClouds(this.draftId, {
            clouds: saveClouds
          }),
        ])
        this.subloading = false

        if (publish) {
          resolve(true)
          return
        }
        this.$notify({
          title: 'Success',
          message: '操作成功',
          type: 'success'
        })
      })
    }
  }
}
</script>
<style lang="scss" scoped>
  .border-b{
    border-bottom: 1px dashed #E5E5E5;
    padding-bottom: 20px;
  }
</style>
