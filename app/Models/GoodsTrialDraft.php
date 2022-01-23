<?php

namespace App\Models;

use App\Helpers\Enums;
use Illuminate\Database\Eloquent\Model;

class GoodsTrialDraft extends Model
{
    protected $table = 'goods_trial_draft';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function goods()
    {
        return $this->belongsTo('App\Models\Goods');
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

    public function checkEdit()
    {
        if ($this->status === Enums::key('status.SUBMIT')) {
            abort(403);
        }
    }
}
