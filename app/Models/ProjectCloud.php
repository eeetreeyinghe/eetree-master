<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectCloud extends Model
{
    protected $table = 'project_cloud';

    protected $guarded = ['id'];

    public function cloud()
    {
        return $this->belongsTo('App\Models\Cloud')->withDefault([
            'url' => '',
        ]);
    }
}
