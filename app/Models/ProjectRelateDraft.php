<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectRelateDraft extends Model
{
    protected $table = 'project_relate_draft';

    protected $guarded = ['id'];

    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'relate_id');
    }
}
