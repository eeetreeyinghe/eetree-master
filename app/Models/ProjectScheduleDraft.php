<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectScheduleDraft extends Model
{
    protected $table = 'project_schedule_draft';

    protected $dates = ['submit_at'];

    protected $guarded = ['id'];
}
