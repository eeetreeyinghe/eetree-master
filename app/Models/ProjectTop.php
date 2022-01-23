<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ProjectTop extends Model
{
    protected $table = 'project_top';

    protected $dates = ['start_at', 'end_at', 'toped_at'];

    protected $guarded = ['id'];

    public static function getTops($where = [])
    {
        $now = Carbon::now();
        $where = array_merge([
            ['is_top', 1],
            ['start_at', '<', $now],
            ['end_at', '>', $now],
        ], $where);
        $topQuery = static::where($where)
            ->where(function ($query) {
                $query->whereRaw('threshold > click_count')
                    ->orWhere('threshold', 0);
            });
        $tops = $topQuery->select('top_id')
            ->orderBy('toped_at', 'desc')
            ->limit(10)
            ->get();
        if ($tops->isEmpty()) {
            return $tops;
        }
        $projectIds = $tops->pluck('top_id');
        ProjectTop::whereIn('top_id', $projectIds)->increment('view_count');
        $query = Project::with(['cloud', 'user:id,avatar,nickname'])
            ->whereNotNull('last_publish_at')
            ->whereIn('id', $projectIds)
            ->get();
        $flip = array_flip($projectIds->toArray());
        return $query->sortBy(function ($item, $key) use ($flip) {
            return $flip[$item->id];
        });
    }
}
