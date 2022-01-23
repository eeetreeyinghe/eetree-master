<?php

namespace App\Http\Resources\Api;

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
        $routeName = $request->route()->getName();
        if ($routeName == 'admin.project.index' && $request->input('simple')) {
            return [
                'id' => $this->id,
                'title' => $this->title,
            ];
        }
        $row = [
            'id' => $this->id,
            'title' => $this->title,
            'summary' => $this->summary,
            'description' => mb_substr(strip_tags($this->description), 0, 100),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'published' => $this->last_publish_at === null ? 0 : 1,
            'cloud_id' => $this->cloud_id,
            'cloud' => [
                'url' => $this->cloud->url,
            ],
            'user' => [
                'nickname' => $this->user->nickname,
            ],
            'url' => route('project.detail', ['project' => $this->id]),
        ];
        if ($routeName == 'admin.project.index') {
            if ($this->dt_is_top === null) {
                $row['projectTop'] = false;
            } else {
                $projectTop = array();
                foreach ($this->getAttributes() as $key => $value) {
                    if (strpos($key, 'dt_') === 0) {
                        $key = substr($key, 3);
                        $projectTop[$key] = $value;
                    }
                }
                $projectTop['date'] = [$projectTop['start_at'], $projectTop['end_at']];
                unset($projectTop['start_at'], $projectTop['end_at']);
                $row['projectTop'] = $projectTop;
            }
        }
        return $row;
    }
}
