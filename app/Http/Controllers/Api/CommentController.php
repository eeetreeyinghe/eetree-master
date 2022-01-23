<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Enums;
use App\Http\Resources\Api\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //返回菜单列表
    public function index(Request $request)
    {
        if ($request->sType === 'project') {
            $comments = Comment::with(['user', 'project'])->where('type', Enums::key('types.PROJECT'))->orderBy('created_at', 'desc')->paginate(config('eetree.adminLimit'));
            return $this->success(CommentResource::collection($comments));
        } else {
            $comments = Comment::with(['user', 'doc'])->where('type', Enums::key('types.DOC'))->orderBy('created_at', 'desc')->paginate(config('eetree.adminLimit'));
            return $this->success(CommentResource::collection($comments));
        }
    }

    public function toggle(Comment $comment)
    {
        if ($comment->active) {
            $active = 0;
        } else {
            $active = 1;
        }
        \DB::transaction(function () use ($comment, $active) {
            $comment->update(['active' => $active]);
            if ($comment->comment_id) {
                if ($active === 0) {
                    Comment::where('id', $comment->comment_id)->decrement('reply_num');
                } else {
                    Comment::where('id', $comment->comment_id)->increment('reply_num');
                }
            }
        });
        return $this->success(['active' => $active]);
    }
}
