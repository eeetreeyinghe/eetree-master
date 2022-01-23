<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RevenueLog extends Model
{
    protected $table = 'revenue_log';

    protected $dates = ['paid_at'];

    protected $guarded = ['id'];

    public function orderItem()
    {
        return $this->belongsTo('App\Models\OrderItem', 'item_id');
    }
}
