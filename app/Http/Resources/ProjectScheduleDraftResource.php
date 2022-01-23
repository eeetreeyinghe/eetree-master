<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectScheduleDraftResource extends JsonResource
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
            'video_code' => $this->video_code,
            'description' => $this->description,
            'submit_at' => $this->submit_at ? $this->submit_at->format('Y-m-d') : '',
        ];
    }
}
