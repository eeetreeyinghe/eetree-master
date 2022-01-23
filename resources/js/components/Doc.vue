<template>
    <div>
        <div class="node-link" v-if="docBreadcrumbs.length > 1">
            <span v-for="(docBreadcrumb, index) in docBreadcrumbs" class="diritem" :key="'docBreadcrumb' + index" @click="enterNode(docBreadcrumb)">{{ docBreadcrumb.text }}<span v-if="index < docBreadcrumbs.length - 1"> &gt;</span></span>
        </div>
        <!-- <div class="root-title">
            <a v-if="docNode.data.hyperlink" :href="docNode.data.hyperlink" target="_blank">{{ docNode.data.text }}</a>
            <span v-else>{{ docNode.data.text }}</span>
            <i v-if="docNode.data.note" class="fa fa-file-text-o noteicon" @click="toggleNote = !toggleNote"></i>
            <p v-if="docNode.data.note" class="previewer-content" :class="{'d-none': !toggleNote}" v-html="docNode.data.note"></p>
            <img v-if="docNode.data.image" :src="docNode.data.image">
        </div> -->
        <div class="card-list" v-if="docNode.children && docNode.children.length > 0">
            <xy-doc-node v-for="child in docNode.children" :key="child.data.id"
                :depth="1"
                :doc-node="child"
                @nodeClick="enterNode"
            ></xy-doc-node>
        </div>
        <!-- <b-modal ref="move-modal" title="选择文件夹" @ok="doSave">
          <xy-folder :list="docCategories" @nodeClick="selectDestCategory"></xy-folder>
        </b-modal> -->
        <el-dialog title="选择文件夹" :visible.sync="dialogMoveModal">
            <xy-folder :list="docCategories" @nodeClick="selectDestCategory"></xy-folder>
            <div slot="footer" class="dialog-footer">
                <el-button @click="dialogMoveModal = false">取消</el-button>
                <el-button type="primary" @click="doSave">保存</el-button>
            </div>
        </el-dialog>

    </div>
</template>

<script>
    import { deepClone, unflatten } from '@/js/utils'
    import { getCategoryList } from '@/js/api/category'
    import { copyDoc } from '@/js/api/doc'
	export default {
		name: 'xydoc',
        data() {
            return {
                dialogMoveModal:false,
                docBreadcrumbs: [],
                docNode: null,
                docCategories: [],
                destCategoryId: null,
                toggleNote: false,
            }
        },
		props: {
            rootNode: Object,
            docId: Number,
        },
        created() {
            this.docNode = this.rootNode
            if (this.docNode.data.note) {
                this.docNode.data.note = marked(this.docNode.data.note);
            }
            if ($('#doc-novue').length > 0) {
                this.$nextTick(() => {
                    $('#doc-novue').remove();
                })
            }
            if ($('.no-login').length == 0) {
                this.getCategoryList()
            }
        },
        methods: {
            getCategoryList() {
                getCategoryList().then(res => {
                    res.data.forEach(element => {
                        element.selected = false
                    })
                    let docCategories = res.data
                    this.docCategories = [
                        {
                            id: 0,
                            name: 'root',
                            selected: false,
                            children: unflatten(docCategories)
                        }
                    ]
                })
            },
            saveDoc() {
                if ($('.no-login').length > 0) {
                    location.href = '/login';
                    return;
                }
                this.destCategoryId === null
                // this.$refs['move-modal'].show()
                this.dialogMoveModal = true
            },
            selectDestCategory(row) {
                this.unselectCategory(this.docCategories)
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
            doSave() {
                copyDoc(this.docId, {
                    user_category_id: this.destCategoryId,
                    node: this.docNode.data.id
                }).then(res => {
                    location.href = res.data.url
                })
            },
            enterNode(nodeData) {
                this.breadcrumbs(this.rootNode, nodeData, [this.rootNode.data])
                this.doEnter(this.rootNode, nodeData)
            },
            doEnter(searchNode, nodeData) {
                if (searchNode.data.id == nodeData.id) {
                    $('.detail-title').text(searchNode.data.text)
                    this.docNode = deepClone(searchNode)
                } else if (searchNode.children && searchNode.children.length > 0) {
                    searchNode.children.forEach(element => {
                        this.doEnter(element, nodeData)
                    })
                }
            },
            breadcrumbs(searchNode, nodeData, parent) {
                if (searchNode.data.id == nodeData.id) {
                    this.docBreadcrumbs = parent
                } else if (searchNode.children && searchNode.children.length > 0) {
                    searchNode.children.forEach(element => {
                        const nextP = deepClone(parent)
                        nextP.push(element.data)
                        this.breadcrumbs(element, nodeData, nextP)
                    })
                }
            }
        }
	}
</script>