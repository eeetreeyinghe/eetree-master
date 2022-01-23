<?php

namespace App\Http\Resources;

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
            'doc_id' => $this->doc_id,
            'title' => $this->title,
            'status' => $this->status,
            'review_remarks' => $this->review_remarks,
            'submit_at' => $this->submit_at->format('Y-m-d'),
        ];
    }
}
