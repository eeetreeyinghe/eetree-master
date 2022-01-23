<?php

namespace App\Http\Resources\Api;

use App\Helpers\Enums;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'nickname' => $this->nickname,
            'mobile' => is_numeric($this->mobile) ? $this->mobile : '',
            'avatar' => $this->avatar,
            'revenue' => $this->revenue,
            'user_type' => $this->user_type,
            'user_type_label' => Enums::label('user.types', $this->user_type),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'can_delete' => $this->user_type == Enums::key('user.types.EDITOR'),
            'is_admin' => $this->user_type == Enums::key('user.types.ADMIN'),
            'is_super' => $this->user_type == Enums::key('user.types.SUPER'),
        ];
    }
}
