<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectProduct extends Model
{
    protected $table = 'project_product';

    protected $guarded = ['id'];

    protected $casts = [
        'data' => 'array',
    ];
}
