<?php

namespace App\Http\Resources;

use App\Helpers\Enums;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'status' => $this->status,
            'status_label' => Enums::label('status', $this->status),
            'review_remarks' => $this->review_remarks,
            'created_at' => $this->created_at->format('Y-m-d'),
            'cloud' => [
                'url' => $this->cloud->url,
            ],
            'url' => $this->project_id ? route('project.detail', ['project' => $this->project_id]) : '',
        ];
        $routeName = $request->route()->getName();
        if ($routeName == 'projectDraft.store' || $routeName == 'projectDraft.edit') {
            $row['cloud_id'] = $this->cloud_id;
            $row['video_code'] = $this->video_code;
            $row['description'] = $this->description;
            $row['team_intro'] = $this->team_intro;
            $row['tags'] = [];
            $row['teams'] = [];
            $row['tag_ids'] = $this->tags->pluck('id');
            $this->tags->each(function ($tag) use (&$row) {
                $row['tags'][] = [
                    'id' => $tag->id,
                    'name' => $tag->name,
                ];
            });
            $this->teams->each(function ($team) use (&$row) {
                $row['teams'][] = [
                    'id' => $team->id,
                    'cloud_id' => $team->cloud_id,
                    'name' => $team->name,
                    'description' => $team->description,
                    'cloud_url' => $team->cloud->url,
                ];
            });
        }

        return $row;
    }
}
