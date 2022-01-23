<?php

namespace App\Http\Resources;

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
        $goods = $this->orderItems->first()->projectGoods;
        return [
            'id' => $this->id,
            'status' => $this->status,
            'status_label' => Enums::label('order.status', $this->status),
            'order_no' => $this->order_no,
            'time' => $this->created_at->format('Y-m-d H:i'),
            'total_fee' => $this->total_fee,
            'quantity' => $this->orderItems->first()->quantity,
            'project' => [
                'id' => $goods->project->id,
                'title' => $goods->project->title,
            ],
            'goods' => [
                'name' => $goods->name,
                'cloud_url' => $goods->cloud->url,
                'url' => route('project.detail', ['project' => $goods->project_id]),
            ],
        ];
    }
}
