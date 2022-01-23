<?php

namespace App\Models;

use App\Helpers\Enums;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    protected $table = 'likes';

    protected $fillable = [
        'user_id', 'like_id', 'type',
    ];

    public function doc()
    {
        return $this->belongsTo('App\Models\Doc', 'like_id');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'like_id');
    }

    public function liked()
    {
        if ($this->type == Enums::key('types.DOC')) {
            $doc = Doc::where('id', $this->like_id)->first();
            $doc->increment('like_count');
            User::where('id', $doc->user_id)->increment('like_count');
        } else {
            $project = Project::where('id', $this->like_id)->first();
            $project->increment('like_count');
            User::where('id', $project->user_id)->increment('pj_like_count');
        }
    }

    public function unliked()
    {
        if ($this->type == Enums::key('types.DOC')) {
            $doc = Doc::where('id', $this->like_id)->first();
            $doc->decrement('like_count');
            User::where('id', $doc->user_id)->decrement('like_count');
        } else {
            $project = Project::where('id', $this->like_id)->first();
            $project->decrement('like_count');
            User::where('id', $project->user_id)->decrement('pj_like_count');
        }
    }
}
