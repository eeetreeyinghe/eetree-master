<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recommend extends Model
{
    protected $table = 'recommend';

    protected $guarded = ['id'];

    public function cloud()
    {
        return $this->belongsTo('App\Models\Cloud')->withDefault([
            'url' => '',
        ]);
    }
}
