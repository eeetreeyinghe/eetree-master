<?php

namespace App\Http\Resources\Api;

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
        $row = [
            'id' => $this->id,
            'content' => $this->content,
            'active' => $this->active,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'user' => [
                'nickname' => $this->user->nickname,
            ],
        ];
        if ($request->sType == 'project') {
            $row['project'] = [
                'title' => $this->project->title,
                'url' => route('project.detail', ['project' => $this->project->id]),
            ];
        } else {
            $row['doc'] = [
                'title' => $this->doc->title,
                'url' => route('doc.detail', ['doc' => $this->doc->id]),
            ];
        }
        return $row;
    }
}
