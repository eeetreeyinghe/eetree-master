<?php

namespace App\Http\Resources;

use App\Helpers\Enums;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectProductDraftResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->product_id ? [
            'id' => $this->product->id,
            'name' => $this->product->name,
            'description' => $this->product->description ?: ($this->product->supplier ? $this->product->supplier->name : ''),
            'link' => $this->product->link,
            'type' => $this->product->type,
            'image' => $this->product->cloud->url,
        ] : [
            'name' => $this->data['name'],
            'description' => $this->data['description'],
            'link' => $this->data['link'],
            'type' => Enums::key('product.types.COMPONENT'),
            'image' => $this->data['image'] ?: '',
        ];
    }
}
