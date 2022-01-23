<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GoodsTrialResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'publish_at' => $this->publish_at->format('Y-m-d H:i:s'),
            'user' => [
                'nickname' => $this->user->nickname,
                'avatar' => $this->user->avatar,
            ],
            'cloud' => [
                'url' => $this->cloud->url,
            ],
            'attachment' => $this->attachment ? [
                'fname' => $this->attachment->fname,
                'url' => $this->attachment->url,
            ] : null,
        ];
        return $row;
    }
}
