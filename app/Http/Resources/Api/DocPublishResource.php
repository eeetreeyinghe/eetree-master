<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class DocPublishResource extends JsonResource
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
            'type' => $this->type,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'submit_at' => $this->submit_at ? $this->submit_at->format('Y-m-d H:i:s') : '',
            'docCategory' => $this->docCategory->pluck('category_id'),
            'user' => [
                'nickname' => $this->user->nickname,
            ],
        ];
    }
}
