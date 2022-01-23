<?php

namespace App\Models;

use App\Helpers\Enums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class ProjectDraft extends Model
{
    use SoftDeletes;

    protected $table = 'project_draft';

    protected $dates = ['submit_at', 'start_at', 'end_at'];

    protected $guarded = ['id'];

    public function getMorphClass()
    {
        return Enums::key('types.PROJECT');
    }

    public function cloud()
    {
        return $this->belongsTo('App\Models\Cloud')->withDefault([
            'url' => '',
        ]);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function college()
    {
        return $this->belongsTo('App\Models\College');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function checkPermission()
    {
        $user = Auth::user();
        if ($this->user_id != $user->id && !$user->isAdmin()) {
            abort(403);
        }
    }

    public function checkEdit()
    {
        $user = Auth::user();
        if (!$user->isAdmin() && $this->status === Enums::key('status.SUBMIT')) {
            abort(403);
        }
    }

    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'item', 'tag_link_draft');
    }

    public function projectClouds()
    {
        return $this->hasMany('App\Models\ProjectCloudDraft', 'project_draft_id');
    }

    public function clouds()
    {
        return $this->belongsToMany('App\Models\Cloud', 'project_cloud_draft', 'project_draft_id', 'cloud_id')->withTimestamps();
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'project_product_draft', 'project_draft_id', 'product_id')->withTimestamps();
    }

    public function relates()
    {
        return $this->belongsToMany('App\Models\Project', 'project_relate_draft', 'project_draft_id', 'relate_id')->withTimestamps();
    }

    public function courses()
    {
        return $this->hasMany('App\Models\ProjectCourseDraft', 'project_draft_id');
    }

    public function cases()
    {
        return $this->hasMany('App\Models\ProjectCaseDraft', 'project_draft_id');
    }

    public function goods()
    {
        return $this->hasMany('App\Models\ProjectGoodsDraft', 'project_draft_id');
    }

    public function teams()
    {
        return $this->hasMany('App\Models\ProjectTeamDraft', 'project_draft_id');
    }

    public function schedules()
    {
        return $this->hasMany('App\Models\ProjectScheduleDraft', 'project_draft_id');
    }

    public function setReview()
    {
        $this->update([
            'status' => Enums::key('status.SUBMIT'),
            'submit_at' => \Carbon\Carbon::now(),
        ]);
    }

    public function unsetReview()
    {
        if ($this->status == Enums::key('status.SUBMIT')) {
            $this->update([
                'status' => Enums::key('status.DRAFT'),
            ]);
        }
    }
}
