<?php

namespace App\Http\Resources\Api;

use App\Helpers\Enums;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->orderItems->each(function ($item) {
            $item->projectGoods->project->url = route('project.detail', ['project' => $item->projectGoods->project->id]);
        });
        return [
            'id' => $this->id,
            'order_no' => $this->order_no,
            'status' => $this->status,
            'status_label' => Enums::label('order.status', $this->status),
            'price' => $this->price,
            'orderItems' => $this->orderItems,
            'deleted_at' => $this->deleted_at,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'nickname' => $this->user->nickname,
                'avatar' => $this->user->avatar,
                'mobile' => $this->user->mobile,
            ],
            'address' => [
                'name' => $this->name,
                'mobile' => $this->mobile,
                'address' => $this->address,
                'postcode' => $this->postcode,
            ],
            'paylog' => $this->paylog ? [
                'out_trade_no' => $this->paylog->out_trade_no,
            ] : null,
        ];
    }
}
