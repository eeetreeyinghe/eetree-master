<?php

namespace App\Http\Resources;

use App\Helpers\Enums;
use Illuminate\Http\Resources\Json\JsonResource;

class RevenueResource extends JsonResource
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
            'paid_at' => $this->paid_at->format('m/d H:i'),
            'title' => $this->orderItem->projectGoods->project->title . ' - ' . $this->orderItem->projectGoods->name,
            'quantity' => $this->orderItem->quantity,
            'fee' => $this->orderItem->fee,
            'revenue' => $this->revenue,
            'type_label' => $this->type == Enums::key('order.type.PROMOTE') ? Enums::label('order.type', $this->type) : '',
        ];
    }
}
