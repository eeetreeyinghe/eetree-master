<template>
  <div class="address-part">
    <div v-if="isMobile && !ucenter">
      <template v-if="list.length>0">
        <div v-for="(row, index) in list" :key="'address' + index">
          <div v-if="row.isActive" class="default-address-show" @click="showMobileList()">
            <i class="el-icon-location-outline left-m-address"></i>
            <div class="middle-m-address">
              <div class="address-title"><h3 class="font18">{{ row.name }}</h3><p class="font13">{{ row.mobile }}</p></div>
              <p class="font13">{{ row.area[0] }} {{ row.area[1] }} {{ row.area[2] }} <br>{{ row.address }}</p>
            </div>
            <div class="right-m-address">
              <i class="el-icon-arrow-right"></i>
            </div>
          </div>
        </div>
      </template>
      <template v-if="list.length==0 && !listLoading">
        <div class="creat-address" @click="handleAdd">
          <i class="el-icon-circle-plus"></i>
          <p>添加新地址</p>
        </div>
      </template>
    </div>
    <div v-else>
      <ul class="address-list" :class="{'address-list-center': ucenter}" :style="showMore ? 'height:auto;':''" v-loading="listLoading">
        <li v-for="(row, index) in list" :key="'address' + index" :class="{'active': row.isActive}" @click="activeAddr(row)">
          <h4 class="font18">{{ row.name }}</h4>
          <p class="font14 address-phone">{{ row.mobile }}</p>
          <p class="font14 address-desc">{{ row.area[0] }} {{ row.area[1] }} {{ row.area[2] }} <br>{{ row.address }}</p>
          <div  class="font14 float-r">
            <div class="edit-text" @click.stop.prevent="handleEdit(row)">修改</div>
            <div class="del-text" v-if="ucenter" @click="delAddress(row, index)">删除</div>
          </div>
        </li>
        <li v-if="!listLoading">
          <div class="creat-address" @click="handleAdd">
            <i class="el-icon-circle-plus"></i>
            <p>添加新地址</p>
          </div>
        </li>
      </ul>
      <div class="more-address-button" v-if="!ucenter" @click="showMore = !showMore"> 
        更多地址 <i :class="showMore?'el-icon-arrow-up':'el-icon-arrow-down'"></i>
      </div>
    </div>
    <el-dialog v-if="isMobile" :visible.sync="mobileListVisible" class="addressDialog" title="所有地址" >
      <div class="default-address-show address-part"  :class="{'active': row.isActive}" v-for="(row, index) in list" :key="'address' + index"  @click.stop.prevent="activeAddr(row)">
        <i class="el-icon-location-outline left-m-address"></i>
        <div class="middle-m-address">
          <div class="address-title"><h3 class="font18">{{ row.name }}</h3><p class="font13">{{ row.mobile }}</p></div>
          <p class="font13">{{ row.area[0] }} {{ row.area[1] }} {{ row.area[2] }} <br>{{ row.address }}</p>
        </div>
        
        <div class="right-m-address" @click.stop.prevent="handleEdit(row)" >
          <i class="el-icon-arrow-right"></i>
        </div>
      </div>
      <div class="creat-address" @click="handleAdd">
        <i class="el-icon-circle-plus"></i>
        <p>添加新地址</p>
      </div>
    </el-dialog>
    <el-dialog :visible.sync="addressVisible" class="addressDialog" :title="dialogType=='edit'?'编辑地址':'新增地址'" >
      <div class="edit-form">
        <el-form ref="addressForm" :model="address" :rules="rules" label-width="80px">
          <el-form-item label="姓名" prop="name">
            <el-input v-model="address.name"/>
          </el-form-item>
          <el-form-item label="手机号" prop="mobile">
            <el-input v-model="address.mobile" />
          </el-form-item>
          <el-form-item label="邮编" prop="postcode">
            <el-input v-model="address.postcode" />
          </el-form-item>
          <el-form-item label="地区" prop="area" v-if="areaShow">
            <el-cascader v-model="address.area" :props="{ value: 'label' }" :options="areaOptions">
            </el-cascader>
          </el-form-item>
          <el-form-item label="详细地址" prop="address">
            <el-input type="textarea" v-model="address.address" />
          </el-form-item>
          <el-form-item label="默认地址">
            <el-switch v-model="address.default" :inactive-value="0" :active-value="1" ></el-switch>
          </el-form-item>
        </el-form>
      </div>
      <div slot="footer" class="dialog-footer">
        <el-button @click="addressVisible = false">取消</el-button>
        <el-button type="primary" @click="confirmSubmit" v-loading="saving">确定</el-button>
      </div>
    </el-dialog>
  </div>
</template>

<script>
import { getAddresses, addAddress, updateAddress, deleteAddress } from '@/js/api/user'
import { regionData } from 'element-china-area-data'
import { deepClone, checkMobile } from '@/js/utils'
const defaultAddress = {
  name: '',
  mobile: '',
  area: [],
  address: '',
  postcode: '',
  default: 0,
}

export default {
  name:'AddressList',
  props:{
    ucenter: {
      type: Boolean,
      default: false
    }
  },
  data () {
    return {
      isMobile: window.innerWidth <= 481,
      listLoading: false,
      saving: false,
      areaShow: false,
      list: [],
      mobileListVisible: false,
      addressVisible: false,
      dialogType: 'new',
      address: {},
      showMore: false,
      areaOptions: regionData,
      rules: {
        name: [
          { required: true, message: '请填写姓名', trigger: 'blur' },
        ],
        mobile: [
          { required: true, message: '请填写手机号', trigger: 'blur' },
          { validator: checkMobile, trigger: 'blur' }
        ],
        address: [
          { required: true, message: '请填写详细地址', trigger: 'blur' },
        ],
        area: [
          { required: true, message: '请选择地区', trigger: 'blur' },
        ],
      }
    }
  },
  created() {
    this.getList()
  },
  methods: {
    async getList() {
      this.listLoading = true;
      const res = await getAddresses();
      const getAddress = res.data

      getAddress.forEach((row, index) => {
        row.area = [row.province, row.city, row.district]
      })
      this.list = getAddress
      this.activeAddr()
      this.listLoading = false
    },
    activeAddr(activeRow = null) {
      if (this.list.length <= 0) return
      let hasDefault = false
      this.list.forEach(row => {
        row.isActive = activeRow && row.id === activeRow.id ? true : false
        if (!activeRow && row.default === 1) {
          hasDefault = true
          activeRow = row
          row.isActive = true
        }
      })
      if (!activeRow && !hasDefault) {
        activeRow = this.list[0]
        activeRow.isActive = true
      }
      if (!this.ucenter) {
        $('#activeAddressId').val(activeRow.id)
      }
      this.mobileListVisible = false
    },
    handleAdd(){
      this.areaShow = false
      this.address = deepClone(defaultAddress)
      this.dialogType = 'new'
      this.addressVisible = true
      this.$nextTick(() => {
        this.areaShow = true
      })
    },
    handleEdit(row){
      this.areaShow = false
      this.address = deepClone(row)
      this.dialogType = 'edit'
      this.addressVisible = true
      this.$nextTick(() => {
        this.areaShow = true
      })
    },
    fields(address) {
      return {
        name: address.name,
        mobile: address.mobile,
        address: address.address,
        postcode: address.postcode,
        province: address.area[0],
        city: address.area[1],
        district: address.area[2],
        default: address.default,
      }
    },
    async confirmSubmit() {
      if (this.saving) {
        return
      }
      this.$refs['addressForm'].validate(async (valid) => {
        this.saving = true
        try {
          if (valid) {
            const isEdit = this.dialogType === 'edit'
            if (isEdit) {
              await updateAddress(this.address.id, this.fields(this.address))
              for (let index = 0; index < this.list.length; index++) {
                if (this.list[index].id === this.address.id) {
                  this.list.splice(index, 1, Object.assign({}, this.address))
                  break
                }
              }
            } else {
              const { data } = await addAddress(this.fields(this.address))
              this.address.id = data.id
              if (this.address.default === 1) {
                this.list.forEach(row => {
                  row.default = 0
                })
              }
              this.list.push(this.address)
            }
            this.activeAddr(this.address)
            this.addressVisible = false

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
    },
    delAddress(row, index) {
      // 删除
      this.$confirm('确认删除地址？', '地址删除', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
      }).then(async () => {
        this.$message({
          type: 'success',
          message: '删除成功!'
        });
        await deleteAddress(row.id)
        this.list.splice(index, 1)
        this.activeAddr()
      }).catch(() => {
        this.$message({
          type: 'info',
          message: '已取消删除'
        });
      });
    },
    showMobileList(){
      this.mobileListVisible = true
    }
  },
}
</script>

<style lang="scss" scoped>
.del-text{
  visibility: hidden;
  color: #409EFF;
  display: inline-block;
  vertical-align: middle;
}
.address-list {
    overflow: hidden;
    height: 160px;
    li {
      float: left;
      border: 1px solid #E1E1E1;
      padding:18px 12px 12px 16px;
      margin-bottom:15px;
      cursor: pointer;
      width: 24%;
      margin-right: 1%;
      height: 160px;
      overflow: hidden;
    }
    h4{
      color: #4A4A4A;
    }
    p{
      color: #666666;
    }
    .address-phone{
        margin-bottom:0;
    }
    .address-desc{
      margin-bottom:3px;
      max-height: 60px;
      overflow: hidden;
    }
    .edit-text,.del-text{
      visibility: hidden;
      color: #409EFF;
      display: inline-block;
      vertical-align: middle;
    }
    .edit-text{
      margin-right: 5px;
    }
    li:hover,li.active{
      border-color:#409EFF;
      .edit-text,.del-text{
        visibility: visible;
      }
    }
    .creat-address{
      height: 122px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      i{
        font-size: 30px;
        margin-bottom:10px;
      }
      i:before{
        color:#e1e1e1;
      }
      p{
        font-size: 14px;
        color: #bbb;
      }  
    }    
  }
.address-list-center {
  height: auto;
  li{
    width: 31%;
    margin-right: 2%;
  }
}
.more-address-button {
  background: #EEEEEE;
  font-size: 14px;
  color:#666666;
  padding:12px;
  text-align:center;
  cursor: pointer;
  margin-bottom: 40px;
  i{
      font-weight: bold;
  }
}

@media screen and (max-width: 769px) {
  .address-list li{
    width:32%;
  }
}
@media screen and (max-width: 481px) {
  .default-address-show{
    background: #fff;
    .address-title{
      margin-bottom:9px;
      h3,p{
        display: inline-block;
        vertical-align: bottom;
      }
      h3{
        font-weight: 600;
        color: #4A4A4A;
        margin-right:12px;
        margin-bottom: 0;
      }
    }
    .left-m-address,
    .middle-m-address,
    .right-m-address{
      display: inline-block;
    }
    .left-m-address{
      font-size:24px;
      color: #666;
      vertical-align: top;
      padding-top: 3px;
    }
    .middle-m-address{
      vertical-align: top;
      width: 85%;
      p{
        font-weight: 500;
        color: #666666;
        margin-bottom: 0;
      }
    }
    .right-m-address{
      vertical-align: middle;
      float: right;
      padding-top: 7%;
    }
  }
  .default-address-show.active{
    border: 1px solid #409EFF;
    margin-bottom:10px;
  }
  .creat-address{
    background: #fafafa;
    border: 1px solid #409EFF;
    text-align: center;
    color: #409EFF;
    width: 80%;
    margin: 0 auto;
    padding: 10px 0;
    i,p{
      display: inline-block;
      vertical-align: middle;
      margin-bottom: 0;
    }
    i{
      font-size: 20px;
    }
    p{
       font-size: 13px;
    }
  }
  .edit-form{
    padding: 10px 10px 30px;
    background: #fff;
  }
}

</style>
<style scoped>
  @media screen and (max-width: 481px) {
    .addressDialog >>> .el-dialog{
      width: 100%;
      min-height: 100%;
      margin-top: 0 !important;
      margin-bottom: 0;
      background: #fafafa;
    }
    .addressDialog >>> .el-dialog__header{
      background: #fff;
    }
    .addressDialog >>> .el-dialog__body{
      padding: 0;
    }
    .addressDialog >>> .el-dialog__footer{
      background: #fafafa;
    }
    .addressDialog >>> .el-dialog__headerbtn{
      display: none;
    }
  }
</style>

