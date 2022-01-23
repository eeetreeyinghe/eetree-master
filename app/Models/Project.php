<?php

namespace App\Models;

use App\Helpers\Enums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    use SoftDeletes;
    protected $table = 'project';

    protected $dates = ['first_publish_at', 'last_publish_at', 'start_at', 'end_at'];

    protected $guarded = ['id'];

    public function getMorphClass()
    {
        return Enums::key('types.PROJECT');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'project_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function college()
    {
        return $this->belongsTo('App\Models\College');
    }

    public function draft()
    {
        return $this->hasOne('App\Models\ProjectDraft');
    }

    public function schedules()
    {
        return $this->hasMany('App\Models\ProjectSchedule');
    }

    public function courses()
    {
        return $this->hasMany('App\Models\ProjectCourse');
    }

    public function cases()
    {
        return $this->hasMany('App\Models\ProjectCase');
    }

    public function caseProjects()
    {
        return $this->hasMany('App\Models\Project', 'pid');
    }

    public function goods()
    {
        return $this->hasMany('App\Models\ProjectGoods');
    }

    public function clouds()
    {
        return $this->hasMany('App\Models\ProjectCloud');
    }

    public function trials()
    {
        return $this->hasMany('App\Models\GoodsTrial');
    }

    public function teams()
    {
        return $this->hasMany('App\Models\ProjectTeam');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'project_product');
    }

    public function relates()
    {
        return $this->belongsToMany('App\Models\Project', 'project_relate', 'project_id', 'relate_id');
    }

    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'item', 'tag_link');
    }

    public function projectTop()
    {
        return $this->hasOne('App\Models\ProjectTop', 'top_id');
    }

    public function cloud()
    {
        return $this->belongsTo('App\Models\Cloud')->withDefault([
            'url' => '',
        ]);
    }

    public function getActivedateAttribute($value)
    {
        return ($this->start_at ? $this->start_at->format('Y年m月d日 H:i') : $this->first_publish_at->format('Y年m月d日 H:i')) . ' - ' . $this->end_at->format('Y年m月d日 H:i');
    }

    public function getRateAttribute($value)
    {
        if ($this->type == Enums::key('project.type.ACTIVITY') && $this->end_at) {
            $nowStamp = time();
            $startStamp = $this->start_at ? $this->start_at->timestamp : $this->first_publish_at->timestamp;
            $endStamp = $this->end_at->timestamp;

            if ($startStamp > $nowStamp) {
                $rate = 0;
            } elseif ($endStamp === $startStamp) {
                $rate = 100;
            } else {
                $rate = ceil(($nowStamp - $startStamp) / ($endStamp - $startStamp) * 100);
                if ($rate > 100) {
                    $rate = 100;
                }
            }
        } else {
            $rate = $this->fund_goal > 0 ? ceil($this->fund_crowd / $this->fund_goal * 100) : 0;
            if ($rate == 100 && $this->fund_crowd < $this->fund_goal) {
                $rate = 99;
            }
        }
        return $rate;
    }

    public function checkPermission()
    {
        $user = Auth::user();
        if ($this->user_id != $user->id && !$user->isAdmin()) {
            abort(403);
        }
    }
}
