<template>
<div>
  <div class="panel panel-default">
    <el-table
      :data="list"
      v-loading="listLoading"
      style="width: 100%;min-height:300px;">
      <el-table-column
        label="名称"
        align="left"
        width="500">
        <template slot-scope="scope">
          <a v-if="scope.row._type == 'category'" href="javascript:;" @click="toCategory(scope.row.id)" class="flex flex-center-v">
            <div class="image-father"><img class="icon-center margin-r-5" src="/img/icons/folder-img.svg"/></div>
            <span style="margin-left: 10px">{{ scope.row.name }}</span>
          </a>
          <a v-else :href="'/doc/edit/' + scope.row.id" class="flex flex-center-v">
            <div class="image-father"><img class="icon-center" src="/img/icons/doc.svg"></div>{{ scope.row.title }}
          </a>
        </template>
      </el-table-column>
      <el-table-column
        label="最后编辑"
        align="center"
        width="160">
        <template slot-scope="scope">
          <div class="created-time-el">{{ scope.row.last_edit_at }}</div>
        </template>
      </el-table-column>
      <el-table-column label="操作"  align="center" width="150">
        <template slot-scope="scope">
          <el-popover trigger="hover" placement="bottom">
            <ul v-if="scope.row._type == 'category'" class="flex-ul-center">
              <li @click="showMove(scope.row, 'category')">
                <div class="image-father"><img class="icon-center margin-r-5" src="/img/icons/mail-forward.svg"/></div>移动到
              </li>
              <li @click="editCategory(scope.row)" >
                <div class="image-father"><img class="icon-center margin-r-5" src="/img/icons/edit-img.svg"/></div>重命名
              </li>
              <li @click="delCategory(scope.row)" >
                <div class="image-father"><img class="icon-center margin-r-5" src="/img/icons/del-img.svg"/></div>删除
              </li>
            </ul>
            <ul v-else class="flex-ul-center">
              <li @click="showMove(scope.row, 'doc')">
                <div class="image-father"><img class="icon-center margin-r-5" src="/img/icons/mail-forward.svg"/></div>
                移动到
              </li>
              <li @click="editDoc(scope.row)">
                <div class="image-father"><img class="icon-center margin-r-5" src="/img/icons/edit-img.svg"/></div>
                设置
              </li>
              <li @click="dupDoc(scope.row)">
                <div class="image-father"><img class="icon-center margin-r-5" src="/img/icons/copy-img.svg"/></div>
                复制
              </li>
              <li @click="shareDoc(scope.row)">
                <div class="image-father"><img class="icon-center margin-r-5" src="/img/icons/share.svg"/></div>
                分享
              </li>
              <li v-if="scope.row.doc_id !== 0">
                <a :href="'/doc/detail/' + scope.row.doc_id">
                  <div class="image-father"><img class="icon-center" src="/img/icons/doc.svg"></div>查看
                </a>
              </li>
              <li @click="delDoc(scope.row)">
                <div class="image-father"><img class="icon-center margin-r-5" src="/img/icons/del-img.svg"/></div>
                删除
              </li>
            </ul>
            <div slot="reference" class="name-wrapper flex flex-center">
              <div class="image-father"><img class="icon-center margin-r-5" src="/img/icons/set-img.svg"/></div>
            </div>
          </el-popover>
        </template>
      </el-table-column>
    </el-table>
  </div>

  <el-dialog :title="dialogType==='new'?'新建文件夹':'重命名'" :visible.sync="dialogNewModal">
    <el-form ref="categoryForm" :model="category" :rules="newCategoryrules" label-position="left" label-width="70px">
      <el-form-item label="名称" prop="name">
        <el-input v-model="category.name"></el-input>
      </el-form-item>
    </el-form>
    <div slot="footer" class="dialog-footer">
      <el-button @click="dialogNewModal = false">取消</el-button>
      <el-button type="primary" @click="submitCategory">保存</el-button>
    </div>
  </el-dialog>

  <el-dialog class="docModal" :title="docDialogType==='new'?'新建文档':'设置'" :visible.sync="dialogDocModal">
    <h5 class="modalh5" v-if="docDialogType==='new'">选择模板</h5>
    <div class="newfile-temp" v-if="docDialogType==='new'">
      <dl v-for="(docTemplate, index) in docTemplates" :key="'docTemplate' + index" :class="{active: docTemplate.selected}" @click="selTemplate(docTemplate)">
        <dt>{{ docTemplate.title }}</dt>
        <dd>
          <img class="temp-ex" :src="docTemplate.img" :alt="docTemplate.title">
        </dd>
      </dl>
    </div>
    <el-form ref="docForm" :model="doc" :rules="newFilerules" label-position="left" label-width="90px">
      <el-form-item label="文档名称" prop="title">
        <el-input v-model="doc.title"></el-input>
      </el-form-item>
      <el-form-item label="标签" prop="tag_ids">
        <el-select
          style="width:100%;"
          v-model="doc.tag_ids"
          multiple
          :multiple-limit="3"
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
    </el-form>
    <div slot="footer" class="dialog-footer">
      <el-button size="sm" class="button-new" @click="handleDocOk">确定</el-button>
      <el-button size="sm" class="button-new" @click="dialogDocModal=false">取消</el-button>
    </div>
  </el-dialog>

  <el-dialog class="moveModal" title="移动到" :visible.sync="dialogMoveModal">
      <div class="move-div">
        <p class="move-title">移动到：我的文档</p>
        <xy-folder :list="moveCategories" @nodeClick="selectDestCategory"></xy-folder>
      </div>
      <div slot="footer" class="dialog-footer">
        <el-button size="sm"  class="button-new" @click="doMove">确定</el-button>
        <el-button size="sm" class="button-new" @click="dialogMoveModal=false">取消</el-button>
      </div>
  </el-dialog>

  <el-dialog title="文档分享" :visible.sync="dialogShareModal">
    <div class="my-4">
      <div class="input-group mb-3">
        <input id="shareLink" type="text" class="form-control" v-model="shareUrl">
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="button" @click="copyurl()">点击复制</button>
        </div>
      </div>
    </div>
  </el-dialog>
</div>
</template>

<script>
import {
  docTemplates,
  getDocList,
  moveDoc,
  delDoc,
  newDoc,
  dupDoc,
  shareDoc,
  editDoc,
} from '@/js/api/doc'
import {
  newCategory,
  getCategoryList,
  editCategory,
  delCategory,
  moveCategory
} from '@/js/api/category'
import { findTags } from '@/js/api/common'
import { deepClone, unflatten} from '@/js/utils'

let defaultCategory = { id: 0,name: '新建文件夹'}
let defaultDoc = {id: 0, title: '', tag_ids: []}

export default {
  props: {
    parentId: {
      type: Number,
      default: -1
    },
    cid: {
      type: Number,
      default: 0
    },
  },
  data () {
    return {
      dialogNewModal:false,
      dialogDocModal:false,
      dialogMoveModal:false,
      dialogShareModal:false,
      listLoading:false,
      doc:{},
      moveItem: {},
      list:[],
      categoryLen: 0,
      docTemplates: [],
      moveCategories: [],

      moveModal:false,
      newFileModal:false,
      newModal:false,
      tagLoading:false,

      shareUrl: '',
      dialogType: 'new',
      docDialogType: 'new',
      docTitleError: '名称必填',
      nameError: '名称必填',
      moveType: 'doc',

      categoryId: this.cid,
      category: Object.assign({}, defaultCategory),
      destCategoryId: null, 
      tagOptions: [],
      initTagOptions: true,
      newCategoryrules:{
        name: [
          { required: true, message: '请输入名称', trigger: 'blur' }
        ]
      },
      newFilerules: {
        title: [
          { required: true, message: '请输入标题', trigger: 'blur' }
        ],
      },
    }
  },
  created() {
    this.getList()
  },
  methods: {
    async getList() {
      this.listLoading = true
      this.list = []
      
      const res = await getDocList(this.categoryId)
      this.listLoading = false
      res.data.categories.forEach(element => {
        element._type = 'category';
        this.list.push(element);
      });
      this.categoryLen = res.data.categories.length;
      res.data.docs.forEach(element => {
        element._type = 'doc';
        this.list.push(element);
      });
      if (typeof res.data.category.parent_id !== 'undefined') {
        this.$emit('update:parentId', res.data.category.parent_id)
      } else {
        this.$emit('update:parentId', -1)
      }
    },
    toCategory(cid) {
      this.categoryId = cid
      this.getList()
      if (this.categoryId > 0) {
        this.$router.push('/doc/list/' + this.categoryId)
      } else {
        this.$router.push('/doc/list')
      }
    },
    newCategory() {
      this.dialogType = 'new'
      this.category = Object.assign({}, defaultCategory)
      this.dialogNewModal = true
    },
    newDoc() {
      this.docDialogType = 'new'
      this.doc = Object.assign({}, defaultDoc)
      this.dialogDocModal= true
    },
    async getTemplates() {
      // 获取新建文档的模板
      const res = await docTemplates()
      res.data.forEach(element => {
        element.selected = element.selected || false
        this.docTemplates.push(element)
      })
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
    handleDocOk() {
      this.$refs['docForm'].validate((valid) => {
        if (valid) {
          this.submitDoc()
        }else{
          return false;
        }
      })
    },
    submitDoc() {
      if (this.docDialogType === 'new') {
        newDoc({
          user_category_id: this.categoryId,
          title: this.doc.title,
          tpl_id: this.tplId,
          tags: this.doc.tag_ids
        }).then(res => {
          location.href = res.data.url
        })
      } else {
        editDoc(this.doc.id, {
          title: this.doc.title,
          tags: this.doc.tag_ids
        }).then(
          (res) => {
            this.$notify({
              title: 'Success',
              message: '操作成功',
              type: 'success'
            })
            for (let index = this.categoryLen; index < this.list.length; index++) {
              if (this.list[index].id === this.doc.id) {
                this.list.splice(index, 1, Object.assign({}, this.doc))
                break
              }
            }
            this.dialogDocModal= false
          }
        )
      }
    },
    submitCategory(){
      this.$refs['categoryForm'].validate((valid) => {
        if (valid) {
          for (let index = 0; index < this.categoryLen; index++) {
            if (this.list[index].name === this.category.name) {
              if (this.list[index].id === this.category.id) {
                this.dialogNewModal = false
                return false
              } else {
                this.$notify({
                  title: 'Error',
                  message: '已有同名文件夹!',
                  type: 'error'
                })
                return false
              }
            }
          }
          if (this.dialogType === 'new') {
            newCategory({
              name: this.category.name,
              parent_id: this.categoryId
            }).then(res => {
              this.$notify({
                title: 'Success',
                message: '操作成功',
                type: 'success'
              })
              this.category.id = res.data.id
              this.category.last_edit_at = res.data.last_edit_at
              this.category._type = 'category'
              this.list.splice(this.categoryLen, 0, this.category)
              this.categoryLen++
              this.dialogNewModal = false
              this.noDocs = false
            })
          } else {
            editCategory(this.category.id, { name: this.category.name }).then(res => {
                this.$notify({
                  title: 'Success',
                  message: '操作成功',
                  type: 'success'
                })
                for (let index = 0; index < this.categoryLen; index++) {
                  if (this.list[index].id === this.category.id) {
                    this.list[index].name = res.data.name
                    this.list[index].last_edit_at = res.data.last_edit_at
                    break
                  }
                }
                this.dialogNewModal = false
              }
            )
          }
        }
      });
    },
    editCategory(row) {
      this.dialogType = 'edit'
      this.category = deepClone(row)
      // // this.$refs.categoryModal.show()
      this.dialogNewModal = true
    },
    showMove(row, moveType) {
      // 移动到
      const loading = this.$loading({
        lock: true,
        text: 'Loading',
        spinner: 'el-icon-loading',
        background: 'rgba(0, 0, 0, 0.7)'
      })
      this.destCategoryId === null
      this.moveType = moveType
      this.moveItem = deepClone(row)
      getCategoryList().then(res => {
        loading.close()
        res.data.forEach(element => {
          element.selected = false
        })
        let moveCategories = res.data
        if (moveType === 'category') {
          moveCategories = moveCategories.filter(category => {
            return category.id !== this.moveItem.id
          }, this)
        }
        this.moveCategories = [
          {
            id: 0,
            name: 'root',
            selected: false,
            children: unflatten(moveCategories)
          }
        ]
        this.dialogMoveModal = true
      })
    },
    dupDoc(row) {
      // 复制
      dupDoc(row.id).then(res => {
        let returnData = res.status
        if ( returnData == 'success') {
          this.$notify({
            title: 'Success',
            message: '操作成功',
            type: 'success'
          })
          for (let index = this.categoryLen; index < this.list.length; index++) {
            if (this.list[index].id === row.id) {
              this.list.splice(index + 1, 0, res.data)
              break
            }
          }
        }
      })
    },
    shareDoc(row) {
      shareDoc(row.id).then(res => {
        this.shareUrl = window.baseUrl + '/doc/share/' + row.id
        this.dialogShareModal = true
      })
    },
    copyurl() {
      let copyText = document.getElementById('shareLink');
      copyText.select();
      document.execCommand("copy");
      this.$notify({
        title: 'Success',
        message: '链接已复制',
        type: 'success'
      })
    },
    editDoc(row) {
      this.docDialogType = 'edit'
      this.doc = deepClone(row)
      if (this.doc.tags.length > 0) {
        this.doc.tags.forEach(tag => {
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
      this.dialogDocModal = true  
    },
    delDoc(row) {
       this.$confirm('确定删除该文档吗?', {
          confirmButtonText: '确定',
          cancelButtonText: '取消'
        })
        .then(() => {
          delDoc(row.id).then(() => {
            this.$notify({
              title: 'Success',
              message: '操作成功',
              type: 'success'
            })
            for (let index = this.categoryLen; index < this.list.length; index++) {
              if (this.list[index].id === row.id) {
                this.list.splice(index, 1)
                break
              }
            }
          })
        })
        .catch(err => {})
    },
    delCategory(row) {
       this.$confirm('确认删除该文件夹以及所有子文件夹吗？', {
          title: '删除文档',
          confirmButtonText: '确定',
          cancelButtonText: '取消'
        })
        .then(() => {
          delCategory(row.id).then(() => {
            this.$notify({
              title: 'Success',
              message: '删除成功',
              type: 'success'
            })
            for (let index = 0; index < this.categoryLen; index++) {
              if (this.list[index].id === row.id) {
                this.list.splice(index, 1)
                break
              }
            }
          })
        })
        .catch(err => {})
    },
    
    selectDestCategory(row) {
      this.unselectCategory(this.moveCategories)
      row.selected = true
      this.destCategoryId = row.id
    },
    unselectCategory(items) {
      items.forEach(element => {
        element.selected = false
        if (
          typeof element.children !== 'undefined' &&
          element.children.length > 0
        ) {
          this.unselectCategory(element.children)
        }
      })
    },
    doMove() {
      if (this.destCategoryId === null) {
        this.$notify({
          title: 'Error',
          message: '请选择文件夹',
          type: 'error'
        })
        return false
      }
      if (this.moveType === 'doc') {
        if (this.categoryId === this.destCategoryId) {
          this.$notify({
            title: 'Error',
            message: '操作有误，请重试',
            type: 'error'
          })
          return false
        }
        moveDoc(this.moveItem.id, this.destCategoryId).then(() => {
          this.$notify({
            title: 'Success',
            message: '操作成功',
            type: 'success'
          })
          this.dialogMoveModal = false
          this.toCategory(this.destCategoryId)
        })
      } else {
        if (
          this.moveItem.id === this.destCategoryId ||
          this.moveItem.parent_id === this.destCategoryId
        ) {
          this.$notify({
            title: 'Error',
            message: '操作有误，请重试',
            type: 'error'
          })
          return false
        }
        moveCategory(this.moveItem.id, this.destCategoryId).then(() => {
          this.$notify({
            title: 'Success',
            message: '操作成功',
            type: 'success'
          })
          this.dialogMoveModal = false
          this.toCategory(this.destCategoryId)
        })
      }
    },
    selTemplate(docTemplate) {
      this.docTemplates.forEach(element => {
        element.selected = false
      })
      docTemplate.selected = true
      this.tplId = docTemplate.doc_id || 0
    }
  },
  mounted() {
    this.getTemplates()
  }
}
</script>
