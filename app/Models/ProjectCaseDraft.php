<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectCaseDraft extends Model
{
    protected $table = 'project_case_draft';

    protected $guarded = ['id'];

    public function cloud()
    {
        return $this->belongsTo('App\Models\Cloud')->withDefault([
            'url' => '',
        ]);
    }
}
