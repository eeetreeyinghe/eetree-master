<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';

    protected $guarded = ['id'];

    public function ptag()
    {
        return $this->belongsTo('App\Models\Tag', 'pid');
    }
}
