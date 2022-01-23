<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'supplier_id' => $this->supplier_id,
            'supplier' => $this->supplier ? [
                'id' => $this->supplier->id,
                'name' => $this->supplier->name,
            ] : null,
            'type' => $this->type,
            'description' => $this->description,
            'link' => $this->link,
            'cloud_id' => $this->cloud_id,
            'cloud' => [
                'url' => $this->cloud->url,
            ],
        ];
    }
}
