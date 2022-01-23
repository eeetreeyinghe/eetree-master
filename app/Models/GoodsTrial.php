<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsTrial extends Model
{
    protected $table = 'goods_trial';

    protected $dates = ['publish_at'];

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function goods()
    {
        return $this->belongsTo('App\Models\ProjectGoods');
    }

    public function cloud()
    {
        return $this->belongsTo('App\Models\Cloud')->withDefault([
            'url' => '',
        ]);
    }

    public function attachment()
    {
        return $this->belongsTo('App\Models\Cloud', 'attachment_id')->withDefault([
            'url' => '',
        ]);
    }
}
