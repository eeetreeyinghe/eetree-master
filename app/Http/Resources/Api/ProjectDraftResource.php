<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectDraftResource extends JsonResource
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
            'title' => $this->title,
            'project_id' => $this->project_id,
            'platform_id' => $this->platform_id,
            'submit_at' => $this->submit_at ? $this->submit_at->format('Y-m-d H:i:s') : '',
            'user' => [
                'nickname' => $this->user->nickname,
            ],
        ];
        $routeName = $request->route()->getName();
        if ($routeName == 'admin.projectDraft.index') {
            $row['project'] = [
                'pid' => $this->project ? $this->project->pid : 0,
            ];
        }
        return $row;
    }
}
