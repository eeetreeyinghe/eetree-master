<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_item';

    protected $guarded = ['id'];
    public $timestamps = false;

    public function projectGoods()
    {
        return $this->belongsTo('App\Models\ProjectGoods', 'item')->withTrashed();
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
}
