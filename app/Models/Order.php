<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'order';

    protected $guarded = ['id'];

    // public function getRouteKeyName()
    // {
    //     return 'order_no';
    // }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function paylog()
    {
        return $this->hasOne('App\Models\PayLog');
    }

    public function orderItems()
    {
        return $this->hasMany('App\Models\OrderItem');
    }
}
