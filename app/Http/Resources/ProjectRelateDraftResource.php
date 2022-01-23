<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectRelateDraftResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->project->id,
            'title' => $this->project->title,
            'summary' => $this->project->summary,
            'image' => $this->project->cloud->url,
        ];
    }
}
