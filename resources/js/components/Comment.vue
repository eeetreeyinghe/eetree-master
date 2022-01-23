<template>
    <div class="bg-white padding-t-25 padding-b-15">
        <div class="padding-20">
            <h4 class="flex flex-center-v flex-between color222 margin-b-15">
                我要评论
                <button type="button" class="el-button el-button--primary is-plain" v-if="uid > 0" @click="newComment"><span>发表评论</span></button>
                <a class="el-button el-button--primary is-plain" :href="urlLogin" v-else><span>登录后评论</span></a>
            </h4>
            <textarea class="div-comment" name="comments" cols="30" rows="10" placeholder="请在此输入评论内容" v-model="replyComment.content"></textarea>
        </div>
        <div class="comment-list-package margin-t-30" v-loading="loading">
            <div class="line-bottom-e5 margin-b-15 margin-t-15"></div>
            <div v-if="comments.length==0" class="min-hight400 text-center">
                暂无评论内容
            </div>
            <div class="content-list flex flex-center-v flex-start-t" :class="'el-comment-' + row.id" v-for="(row, index) in comments" :key="'comment-' + index">
                <img class="avatar" :src="row.user.avatar"/>
                <div class="comment-list-desc">
                    <h4 class="title flex flex-between">
                        {{ row.user.nickname }}
                        <div class="right-text flex flex-between flex-center-v">
                            {{ row.created_at }}
                            <span class="pointer" @click="delComment(row)" v-if="row.user.id==uid"><i class="el-icon-delete"></i></span>
                            <span class="flex flex-center-v pointer" v-if="row.reply_num > 0" @click="toggleReply(row)"><i class="el-icon-chat-dot-square"></i>{{ row.reply_num }}</span>
                            <span class="pointer" @click="commentReply(row)">{{ row.clickReply ? '取消评论' : '评论' }}</span>
                        </div>
                    </h4>
                    <p class="description">{{ row.content }}</p>
                    <!-- <div class="text-center mt-2" v-if="row.replyLoading">
                        loading <i class="el-icon-loading"></i>
                    </div> -->
                    <!-- 二级回复 -->
                    <div class="comment-list-mini" :class="row.loadingShowBg" :style="(row.clickReply || row.replys.length>0) ? 'margin-top:20px':''"  v-loading="row.replyLoading">
                        <div class="reply-panle clearfix text-muted pt-3 pb-2 reply-padding" v-if="row.clickReply" >
                            <form class="needs-validation btn-block" novalidate="">
                                <textarea cols="30" rows="2" placeholder="输入评论内容" v-model="row.replyComment.content"></textarea>
                                <div class="invalid-feedback">填写有误</div>
                                <button class="btn btn-primary btn-sm btn-block reply-btn" type="button" @click="newReply(row, row)">提交</button>
                            </form>
                        </div>
                        <hr v-if="row.clickReply && row.replys.length > 0">
                        <div :class="row.replys.length>0 ? 'padding-b-15 padding-t-15':''">
                            <div class="mini-li" v-for="(replyRow, index) in row.replys" :key="'reply-' + index">
                                <div class="flex flex-center-v flex-start-t">
                                    <img class="avatar" :src="replyRow.user.avatar"/>
                                    <div class="comment-list-desc">
                                        <h5 class="title flex flex-between">
                                            <div>{{ replyRow.user.nickname }}<span v-if="replyRow.targetUser"> 回复 {{ replyRow.targetUser.nickname }}</span></div>
                                            <div class="right-text flex flex-between flex-center-v">
                                                {{ replyRow.created_at }}
                                                <span class="pointer" @click="delComment(replyRow, row)" v-if="replyRow.user.id==uid"><i class="el-icon-delete"></i></span>
                                                <span class="pointer" @click="commentReply(replyRow)">{{ replyRow.clickReply ? '取消回复' : '回复' }}</span>
                                            </div>
                                        </h5>
                                        <p class="description">{{ replyRow.content }}</p>
                                    </div>
                                </div>
                                <div class="reply-panle clearfix text-muted pt-3" v-if="replyRow.clickReply">
                                    <form class="needs-validation btn-block padding-l-50" novalidate="">
                                        <textarea name="comment" cols="30" rows="2" placeholder="输入回复内容" v-model="replyRow.replyComment.content"></textarea>
                                        <div class="invalid-feedback">填写有误</div>
                                        <el-button size="small" class="btn btn-primary btn-sm reply-btn btn-block" type="button" @click="newReply(row, replyRow)">回复</el-button>
                                    </form>
                                </div>
                                <div class="line-bottom-e5 margin-b-15 margin-t-15" v-if="index !== row.replys.length-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
          <el-button type="primary" v-if="hasMoreComments" :loading="loading" plain size="mini" @click="moreComments">加载更多</el-button>
        </div>
    </div>
</template>
<script>
export default {
    name: 'comment',
    data() {
      return {
        loading: false,
        comments: [],
        noComments: false,
        page: 1,
        hasMoreComments: false,
        replyComment: {
            content: '',
            type: this.commentType,
            item: this.commentItem
        }
      }
    },
    props: {
        commentItem: Number,
        urlIndex: String,
        urlStore: String,
        urlDelete: String,
        urlLogin: String,
        urlReplyList: String,
        urlReply: String,
        commentType: {
            type: Number,
            default: 0
        },
        uid: {
            type: Number,
            default: 0
        },
    },
    created() {
        this.getComments()
    },
    methods: {
        getComments() {
            this.loading = true
            axios({
                method: 'get',
                url: this.urlIndex,
                params: {page: this.page, item: this.commentItem, type: this.commentType}
            }).then(res => {
                this.page = res.meta.current_page
                this.hasMoreComments = res.meta.total / res.meta.per_page > this.page
                for (const i in res.data) {
                    this.comments.push(this.formatComment(res.data[i]))
                }
                if (this.page === 1 && this.comments.length === 0) {
                    this.noComments = true
                }
                this.loading = false
            });
        },
        formatComment(comment) {
            comment.toggleReply = false
            comment.replyLoading = false
            comment.replys = []
            comment.clickReply = false
            comment.replyComment = {
                type: this.commentType,
                content: '',
            }
            comment.pagination = {
                currentPage: 1,
                total: 0,
                perPage: 10,
            }
            return comment;
        },
        formatReply(reply) {
            reply.clickReply = false
            reply.replyComment = {
                type: this.commentType,
                content: '',
            }
            return reply;
        },
        newComment() {
            if (this.replyComment.content == '') {
                this.$notify({
                    title: 'Error',
                    message: '请输入评论内容',
                    type: 'error'
                })
                return false
            }
            axios({
                method: 'post',
                url: this.urlStore,
                data: this.replyComment,
            }).then(res => {
                this.noComments = false
                this.$notify({
                    title: 'Success',
                    message: '评论成功',
                    type: 'success'
                })
                this.comments.unshift(this.formatComment(res.data))
                this.replyComment.content = ''
            });
        },
        newReply(pComment, sComment) {
            if (sComment.replyComment.content == '') {
                this.$notify({
                    title: 'Error',
                    message: '请输入评论内容',
                    type: 'error'
                })
                return false
            }
            axios({
                method: 'post',
                url: this.urlReply.replace('placeholder', sComment.id),
                data: sComment.replyComment
            }).then(res => {
                this.$notify({
                    title: 'Success',
                    message: '评论成功',
                    type: 'success'
                })
                pComment.replys.unshift(this.formatReply(res.data))
                pComment.reply_num++
                sComment.replyComment.content = ''
                sComment.clickReply = false
            });
        },
        moreComments() {
            this.page++;
            this.getComments();
        },
        toggleReply(comment) {
            comment.toggleReply = !comment.toggleReply
            comment.replys = []
            if (comment.toggleReply) {
                this.getReplys(comment, true)
                comment.loadingShowBg = 'loading-bg'
            } else {
                comment.loadingShowBg = ''
            }
        },
        pageReply(comment) {
            this.$nextTick(() => {
                this.getReplys(comment)
            })
        },
        getReplys(comment, refresh) {
            if (refresh) {
                comment.pagination.currentPage = 1
            }
            if (comment.reply_num == 0) {
                return false
            }
            comment.replyLoading = true
            comment.replys = []
            if ($("html,body").scrollTop() > $('.el-comment-' + comment.id).offset().top) {
                $("html,body").animate({scrollTop:$('.el-comment-' + comment.id).offset().top}, 0);
            }
            axios({
                method: 'get',
                url: this.urlReplyList.replace('placeholder', comment.id),
                params: {page: comment.pagination.currentPage}
            }).then(res => {
                for (const i in res.data) {
                    comment.replys.push(this.formatReply(res.data[i]))
                }
                comment.replyLoading = false
                comment.pagination = {
                    currentPage: res.meta.current_page,
                    total: res.meta.total,
                    perPage: res.meta.per_page,
                }
            });
        },
        commentReply(comment) {
            if (this.uid == 0) {
                location.href = this.urlLogin
                return
            }
            comment.clickReply = !comment.clickReply
        },
        delComment(sComment, pComment) {
            axios({
                method: 'delete',
                url: this.urlDelete.replace('placeholder', sComment.id),
            }).then(res => {
                this.$notify({
                    title: 'Success',
                    message: '删除成功',
                    type: 'success'
                })
                if (pComment) {
                    for (let index = 0; index < pComment.replys.length; index++) {
                        if (pComment.replys[index].id == sComment.id) {
                            pComment.replys.splice(index, 1)
                            pComment.reply_num--
                        }
                    }
                } else {
                    for (let index = 0; index < this.comments.length; index++) {
                        if (this.comments[index].id == sComment.id) {
                            this.comments.splice(index, 1)
                        }
                    }
                }
            });
        }
    }
}
</script>
