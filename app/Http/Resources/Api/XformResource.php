<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class XformResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $result = [
            'id' => $this->id,
            'name' => $this->name,
        ];
        if (!$request->input('simple')) {
            $result['data'] = $this->data;
        }
        return $result;
    }
}
