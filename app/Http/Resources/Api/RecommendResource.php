<?php

namespace App\Http\Resources\Api;

use App\Helpers\Enums;
use Illuminate\Http\Resources\Json\JsonResource;

class RecommendResource extends JsonResource
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
            'obj_type' => $this->obj_type,
            'obj_id' => $this->obj_id,
            'title' => $this->title,
            'link' => $this->link,
            'area_id' => $this->area_id,
            'area_label' => Enums::label('recommend.area', $this->area_id),
            'description' => $this->description,
            'cloud_id' => $this->cloud_id,
            'cloud' => [
                'url' => $this->cloud->url,
            ],
            'order' => $this->order,
        ];
    }
}
