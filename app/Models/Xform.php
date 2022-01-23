<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Xform extends Model
{
    protected $table = 'xform';

    protected $casts = [
        'data' => 'array',
    ];

    protected $guarded = ['id'];
}
