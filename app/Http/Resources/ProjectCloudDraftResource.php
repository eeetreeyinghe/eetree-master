<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectCloudDraftResource extends JsonResource
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
            'cloud_id' => $this->cloud_id,
            'type' => $this->type,
            'cloud' => [
                'fname' => $this->cloud->fname,
                'url' => $this->cloud->url,
            ],
            'description' => $this->description,
        ];
    }
}
