<?php

namespace App\Models;

use App\Helpers\Enums;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'favorite';

    protected $fillable = [
        'user_id', 'fav_id', 'type',
    ];

    public function doc()
    {
        return $this->belongsTo('App\Models\Doc', 'fav_id');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'fav_id');
    }

    public function favorited()
    {
        if ($this->type == Enums::key('types.DOC')) {
            $doc = Doc::find($this->fav_id);
            $doc->increment('fav_count');
            User::where('id', $doc->user_id)->increment('fav_count');
        } else {
            $project = Project::find($this->fav_id);
            $project->increment('fav_count');
            User::where('id', $project->user_id)->increment('pj_fav_count');
        }
    }

    public function unfavorited()
    {
        if ($this->type == Enums::key('types.DOC')) {
            $doc = Doc::where('id', $this->fav_id)->first();
            $doc->decrement('fav_count');
            User::where('id', $doc->user_id)->decrement('fav_count');
        } else {
            $project = Project::where('id', $this->fav_id)->first();
            $project->decrement('fav_count');
            User::where('id', $project->user_id)->decrement('pj_fav_count');
        }
    }
}
