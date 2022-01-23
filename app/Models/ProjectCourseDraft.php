<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectCourseDraft extends Model
{
    protected $table = 'project_course_draft';

    protected $guarded = ['id'];

    public function cloud()
    {
        return $this->belongsTo('App\Models\Cloud')->withDefault([
            'url' => '',
        ]);
    }
}
