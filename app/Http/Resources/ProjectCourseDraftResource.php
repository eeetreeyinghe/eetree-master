<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectCourseDraftResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'link' => $this->link,
            'description' => $this->description,
            'cloud_id' => $this->cloud_id,
            'cloud' => [
                'url' => $this->cloud->url,
            ],
        ];
    }
}
