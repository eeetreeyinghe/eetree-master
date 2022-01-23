<?php

namespace App\Http\Resources\Api;

use App\Helpers\Enums;
use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'type_label' => Enums::label('tag.types', $this->type),
        ];
        if ($request->input('ptag') !== '0') {
            $data['ptag'] = $this->ptag ? $this->ptag : ['id' => 0];
        }
        return $data;
    }
}
