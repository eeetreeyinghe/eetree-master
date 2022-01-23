<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectGoods extends Model
{
    use SoftDeletes;
    protected $table = 'project_goods';

    protected $guarded = ['id'];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function xform()
    {
        return $this->belongsTo('App\Models\Xform');
    }

    public function trials()
    {
        return $this->hasMany('App\Models\GoodsTrial');
    }

    public function draftTrials()
    {
        return $this->hasMany('App\Models\GoodsTrialDraft', 'goods_id');
    }

    public function cloud()
    {
        return $this->belongsTo('App\Models\Cloud')->withDefault([
            'url' => '',
        ]);
    }
}
