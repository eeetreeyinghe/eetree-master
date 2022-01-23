<?php

namespace App\Http\Controllers;

use App\Helpers\Enums;
use App\Http\Requests\CommentReplyRequest;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Doc;
use App\Models\Notice;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group comment
 * 评论接口
 */
class CommentController extends ApiController
{
    /**
     * list
     * @queryParam  item required 评论对象ID
     * @queryParam  type required 类型（enums.types.DOC.k、enums.types.PROJECT.k）
     */
    public function index(Request $request)
    {
        $type = (int) $request->input('type', Enums::key('types.DOC'));
        $item = (int) $request->input('item');
        $comments = Comment::with(['user:id,nickname,avatar'])->where([
            ['item', $item],
            ['type', $type],
            ['comment_id', 0],
            ['active', 1],
        ])->orderBy('created_at', 'desc')->paginate(config('eetree.limit'));
        return $this->success(CommentResource::collection($comments));
    }

    /**
     * my comments
     */
    public function userComments(Request $request)
    {
        $type = (int) $request->input('type', Enums::key('types.DOC'));
        $comments = Comment::where([
            ['user_id', Auth::id()],
            ['type', $type],
        ])->orderBy('created_at', 'desc')->paginate(config('eetree.limit'));
        return $this->success(CommentResource::collection($comments));
    }

    /**
     * reply list
     * @urlParam comment required 父评论ID
     */
    public function replyList(Comment $comment)
    {
        $comments = Comment::with(['user:id,nickname,avatar', 'targetUser:id,nickname,avatar'])->where([
            ['comment_id', $comment->id],
            ['active', 1],
        ])->orderBy('created_at', 'desc')->paginate(config('eetree.limit'));
        return $this->success(CommentResource::collection($comments));
    }

    /**
     * add comment
     * @bodyParam  item int required 评论对象ID
     * @bodyParam  type int 评论类型
     * @bodyParam  content string required 评论内容
     */
    public function store(CommentRequest $request)
    {
        $type = (int) $request->input('type', Enums::key('types.DOC'));
        $params = $request->validated();
        $item = $params['item'];
        $content = $params['content'];
        if ($type == Enums::key('types.DOC')) {
            $itemObj = Doc::find($item);
        } else {
            $itemObj = Project::find($item);
        }
        if (empty($itemObj)) {
            return $this->failed('出错了');
        }
        if ($type == Enums::key('types.DOC')) {
            $noticeContent = sprintf(config('notices.doc_comment'), route('doc.detail', ['doc' => $itemObj->id]), $itemObj->title, $content);
        } else {
            $noticeContent = sprintf(config('notices.project_comment'), route('project.detail', ['project' => $itemObj->id]), $itemObj->title, $content);
        }
        $comment = [];
        \DB::transaction(function () use ($itemObj, $type, $content, $noticeContent, &$comment) {
            $user = Auth::user();
            $comment = Comment::create([
                'item' => $itemObj->id,
                'user_id' => $user->id,
                'content' => $content,
                'active' => 1,
                'type' => $type,
            ]);
            if ($user->id !== $itemObj->user_id) {
                Notice::create(array(
                    'user_id' => $itemObj->user_id,
                    'content' => $noticeContent,
                ));
            }
            $comment->user = $user;
        });
        return $this->success(new CommentResource($comment));
    }

    /**
     * reply comment
     * @bodyParam  content string required 评论内容
     */
    public function reply(Comment $target, CommentReplyRequest $request)
    {
        $user = Auth::user();
        $comment = \DB::transaction(function () use ($user, $target, $request) {
            $commentId = $target->comment_id === 0 ? $target->id : $target->comment_id;
            $params = $request->validated();
            $content = $params['content'];
            $comment = Comment::create([
                'item' => $target->item,
                'user_id' => $user->id,
                'comment_id' => $commentId,
                'target_id' => $target->id,
                'target_user_id' => $target->user_id,
                'content' => $content,
                'active' => 1,
                'type' => $target->type,
            ]);
            Comment::where('id', $commentId)->increment('reply_num');
            if ($target->user_id !== $user->id) {
                if ($target->type == Enums::key('types.PROJECT')) {
                    $url = route('project.detail', ['project' => $target->item]);
                } else {
                    $url = route('doc.detail', ['doc' => $target->item]);
                }
                Notice::create(array(
                    'user_id' => $target->user_id,
                    'content' => sprintf(config('notices.comment_reply'), $url . '#commentlist', $content),
                ));
            }
            return $comment;
        });
        $comment->user = $user;
        return $this->success(new CommentResource($comment));
    }

    /**
     * delete comment
     * @urlParam comment 评论ID
     */
    public function delete(Comment $comment)
    {
        if ($comment->user_id != Auth::id()) {
            abort(403);
        }
        \DB::transaction(function () use ($comment) {
            $comment->delete();
            if ($comment->comment_id > 0) {
                Comment::where('id', $comment->comment_id)->decrement('reply_num');
            }
        });

        return $this->success();
    }
}
