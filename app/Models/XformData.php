<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class XformData extends Model
{
    protected $table = 'xform_data';

    protected $casts = [
        'data' => 'array',
    ];

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
