<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectCloudDraft extends Model
{
    protected $table = 'project_cloud_draft';

    protected $guarded = ['id'];

    public function cloud()
    {
        return $this->belongsTo('App\Models\Cloud')->withDefault([
            'url' => '',
        ]);
    }
}
