<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectGoodsDraft extends Model
{
    protected $table = 'project_goods_draft';

    protected $guarded = ['id'];

    public function cloud()
    {
        return $this->belongsTo('App\Models\Cloud')->withDefault([
            'url' => '',
        ]);
    }
}
