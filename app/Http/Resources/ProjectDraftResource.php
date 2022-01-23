<?php

namespace App\Http\Resources;

use App\Helpers\Enums;
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
            'summary' => $this->summary,
            'project_id' => $this->project_id,
            'fund_goal' => $this->fund_goal,
            'status' => $this->status,
            'status_label' => Enums::label('status', $this->status),
            'review_remarks' => $this->review_remarks,
            'created_at' => $this->created_at->format('Y-m-d'),
            'type_label' => Enums::label('project.type', $this->type),
            'cloud' => [
                'url' => $this->cloud->url,
            ],
            'url' => $this->project_id ? route('project.detail', ['project' => $this->project_id]) : '',
        ];
        $routeName = $request->route()->getName();
        if ($routeName == 'projectDraft.store' || $routeName == 'projectDraft.edit') {
            $row['cloud_id'] = $this->cloud_id;
            $row['video_code'] = $this->video_code;
            $row['type'] = $this->type;
            $row['date'] = [$this->start_at ? $this->start_at->format('Y-m-d H:i:s') : '', $this->end_at ? $this->end_at->format('Y-m-d H:i:s') : ''];
            $row['description'] = $this->description;
            $row['rule'] = $this->rule;
            $row['has_agreement'] = $this->has_agreement;
            $row['agreement'] = $this->agreement;
            $row['college_id'] = $this->college_id;
            $row['team_intro'] = $this->team_intro;
            $row['promote'] = $this->promote;
            $row['tags'] = [];
            $row['teams'] = [];
            $row['tag_ids'] = $this->tags->pluck('id');
            $this->tags->each(function ($tag) use (&$row) {
                $row['tags'][] = [
                    'id' => $tag->id,
                    'name' => $tag->name,
                ];
            });
            $this->load('teams.user');
            $this->teams->each(function ($team) use (&$row) {
                $team->getFromUser();
                $row['teams'][] = [
                    'id' => $team->id,
                    'user_id' => $team->user_id,
                    'cloud_id' => $team->cloud_id,
                    'name' => $team->name,
                    'description' => $team->description,
                    'cloud' => [
                        'url' => $team->cloud->url,
                    ],
                ];
            });
            $user = \Illuminate\Support\Facades\Auth::user();
            $row['can_edit'] = (!$user->isAdmin() && $this->status === Enums::key('status.SUBMIT')) ? false : true;
        }

        return $row;
    }
}
