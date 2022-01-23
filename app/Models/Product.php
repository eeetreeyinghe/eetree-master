<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $guarded = ['id'];

    public function cloud()
    {
        return $this->belongsTo('App\Models\Cloud')->withDefault([
            'url' => '',
        ]);
    }

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }
}
