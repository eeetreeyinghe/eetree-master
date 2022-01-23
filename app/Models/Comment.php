<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    protected $table = 'comment';

    protected $guarded = ['id'];

    public function doc()
    {
        return $this->belongsTo('App\Models\Doc', 'item');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'item');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function targetUser()
    {
        return $this->belongsTo('App\Models\User', 'target_user_id');
    }
}
