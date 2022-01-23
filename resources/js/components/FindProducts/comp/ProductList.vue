<template>
<div>
  <div class="select-tags">
    <div class="flex flex-between top-select-div">
      <h4>请选择{{propData.l}}</h4>
      <i class="el-icon-arrow-down"></i>
    </div>
    <el-select
      ref="select"
      class="el-textarea-select"
      v-model="selectedItems"
      multiple
      filterable
      clearable
      remote
      default-first-option
      :loading="listLoading"
      popper-class="sel-products"
      :remote-method="getProducts"
      @change="changeTags"
      @focus="focusTags"
      placeholder="请输入关键词">
      <el-option
        v-for="item in products"
        :key="item.id"
        :value="item.id">
        <slot>
          <div class="hascheck-option"> 
            <div class="img-left" v-if="item.image !== ''">
              <img :src="item.image"/>
            </div>
            <div class="list-group-item-dec" :class="selectedItems.includes(item.id)? 'active':''">
              <h4>{{ item.name }}</h4>
              <p>{{ item.description }}</p>
            </div>
          </div>
        </slot>
      </el-option>
    </el-select>
  </div>
  <div class="list-search-checked">
    <div class="hascheck" v-for="item in checkProduts" :key="item.id" :value="item.id"> 
      <div class="img-left" v-if="item.image !== ''">
        <img :src="item.image"/>
      </div>
      <div class="list-group-item-dec">
        <img class="pos-right" src="/img/icons/del-img.svg" @click="delCheckTag(item.id)"/>
        <h4>{{ item.name }}</h4>
        <p>{{ item.description }}</p>
      </div>
    </div>
  </div>
 </div>
</template>

<script>
import { findProducts } from '@/js/api/project'
import { deepClone } from '@/js/utils'
export default {
  props:{
    propData:{
      type:Object,
      default:()=>{}
    }
  },
  data () {
    return {
      listLoading: false,
      selectedItems: [],
      products: [],
      checkProduts: this.propData.products,
      maxId: 1,
    }
  },
  methods: {
    created() {
      this.checkProduts.forEach(product => {
        if (!product.id) {
          product.id = 'v-' + this.maxId
          this.maxId++
        }
      })
    },
    delCheckTag(id){
      let checkProduts = deepClone(this.checkProduts)
      checkProduts.forEach((element,index) => {
        if(element.id == id){
          this.checkProduts.splice(index,1)
        }
      });
      this.selectedItems = this.checkProduts.map(item=>{
        return item.id
      })
    },
    async focusTags(){
      if (this.products.length === 0) {
        this.getProducts('')
      }
    },
    changeTags(val) {
      this.selectedItems = val
      let checkProduts = []
      let apiCheckProduts = deepClone(this.checkProduts)
      let apiIds = apiCheckProduts.map(item=>{
        return item.id
      })
      checkProduts = this.products.filter(item=>{
        return val.includes(item.id) && !apiIds.includes(item.id)
      })
      let checkProdutsnew = [...apiCheckProduts,...checkProduts]
      this.checkProduts = checkProdutsnew
      this.$emit('on-change', {
        type: this.propData.k,
        products: checkProdutsnew
      })
    },
    async getProducts(q) {
      // 获取下拉列表
      if (q !== '') {
        this.listLoading = true;
        let params = {
            q,
            type: this.propData.k,
        };
        const res = await findProducts(params)
        res.data.forEach(product => {
          if (!product.id) {
            product.id = 'v-' + this.maxId
            this.maxId++
          }
        })
        this.products = res.data
        this.listLoading = false
      } else {
        this.products = [];
      }
    }
  }
}
</script>
<style lang="scss" scoped>
::v-deep .el-select__input:focus{
  border:0;
  outline: none;
  box-shadow: 0 0 3px 3px #b0d7ff;
}
::v-deep .el-select__tags{
  height: 100%;
  max-width: 100% !important;
}
::v-deep .el-select__input{
  height: 100%;
  width: 100%;
  margin-left: 0;
  padding-left: 15px;
  max-width: 100% !important;
}
.select-tags{
  position: relative;
  width:100%;
  height: 105px;
  background:#fff;
  border:1px solid rgba(187,187,187,1);
  .bottom-pos{
    position: absolute;
    width: 100%;
    bottom: 0;
  }
  .top-select-div{
    padding: 10px 10px 10px 15px;
    h4{
      font-weight: 400;
      color: #9B9B9B;
    }
    i{
      font-size: 16px;
      line-height: 21px;
    }
  }
  .el-select{
    width: 97%;
    margin-left: 10px;
    border-radius: 3px;
    border: 1px solid #E5E5E5;
  }
  .el-select:focus{
    border: 1px solid #409EFF;
  }
  .el-select__tags>span{
    display:none;
  }
}
.ellipsis{
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
::v-deep .hascheck-option{
  overflow: hidden;
  display: flex;
  align-items: center;
}
::v-deep .el-tag.el-tag--info{
  display: none;
}
::v-deep .img-left{
  float: left;
  margin-right: 15px;
  width:90px;
  height:90px;
  border:1px solid #eee;
  display: flex;
  align-items: center;
  justify-content: center;
  img{
    max-width: 100%;
    max-height: 100%;
  }
}
.sel-products{
    .el-select-dropdown__item{
      height: auto;
      margin-top: 10px;
      margin-bottom:10px;
    }
    .list-group-item-dec{
      padding-left:1.5rem;
      max-width:550px;
      h4{
          width:100%;
          font-size: 16px;
          line-height:14px;
          margin-bottom: 12px;
          color: #4a4a4a;
          @extend .ellipsis;
      }
      p{
          width:100%;
          font-size:12px;
          line-height:14px;
          color: #777;
          margin-bottom: 0;
          @extend .ellipsis
      }
    }
    .el-select-dropdown__item:hover,
    .el-select-dropdown__item.hover,
    .el-select-dropdown__item.selected{
      background-color: #fff;
      h4,p{
        color: #409EFF;
      }
    }

}

.list-search-checked{
  margin-top: 15px;
  .hascheck{
    overflow: hidden;
    position: relative;
    border:1px solid rgba(187,187,187,1);
    padding:15px;
    margin-bottom: 10px;
  }
  .pos-right{
    position: absolute;
    top: 41%;
    right: 10px;
  }
}

</style>
