<?php

namespace App\Http\Resources;

use App\Helpers\Enums;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $routeName = $request->route()->getName();
        $row = [];
        if ($routeName == 'comment.index' || $routeName == 'comment.store') {
            $row = [
                'id' => $this->id,
                'content' => $this->content,
                'created_at' => $this->created_at->diffForHumans(),
                'reply_num' => $this->reply_num ?: 0,
                'user' => [
                    'id' => $this->user->id,
                    'nickname' => $this->user->nickname,
                    'avatar' => $this->user->avatar,
                ],
            ];
        } else if ($routeName == 'comment.replyList' || $routeName == 'comment.reply') {
            $row = [
                'id' => $this->id,
                'content' => $this->content,
                'created_at' => $this->created_at->diffForHumans(),
                'user' => [
                    'id' => $this->user->id,
                    'nickname' => $this->user->nickname,
                    'avatar' => $this->user->avatar,
                ],
            ];
            if ($this->comment_id !== $this->target_id) {
                $row['targetUser'] = [
                    'id' => $this->user->id,
                    'nickname' => $this->targetUser->nickname,
                    'avatar' => $this->targetUser->avatar,
                ];
            }
        } else if ($routeName == 'comment.userComments') {
            if ($this->type == Enums::key('types.DOC')) {
                $url = route('doc.detail', ['doc' => $this->item]) . '#comments';
            } else {
                $url = route('project.detail', ['project' => $this->item]) . '#comments';
            }
            $row = [
                'id' => $this->id,
                'content' => $this->content,
                'created_at' => $this->created_at->diffForHumans(),
                'url' => $url,
            ];
        }
        return $row;
    }
}
