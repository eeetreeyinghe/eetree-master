<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class DocTop extends Model
{
    protected $table = 'doc_top';

    protected $dates = ['start_at', 'end_at', 'toped_at'];

    protected $fillable = [
        'top_id', 'start_at', 'end_at', 'threshold', 'is_top', 'page_index', 'page_category', 'toped_at',
    ];

    public function docCategory()
    {
        return $this->hasMany('App\Models\DocCategory', 'doc_id', 'top_id');
    }

    public static function getTops($where = [], $categoryId = false, $recordView = true)
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
        if ($categoryId) {
            if (is_array($categoryId)) {
                $topQuery = $topQuery->whereHas('docCategory', function ($query) use ($categoryId) {
                    $query->whereIn('category_id', $categoryId);
                });
            } else {
                $topQuery = $topQuery->whereHas('docCategory', function ($query) use ($categoryId) {
                    $query->where('category_id', $categoryId);
                });
            }
        }
        $tops = $topQuery->select('top_id')
            ->orderBy('toped_at', 'desc')
            ->limit(10)
            ->get();
        if ($tops->isEmpty()) {
            return $tops;
        }
        $docIds = $tops->pluck('top_id');
        DocTop::whereIn('top_id', $docIds)->increment('view_count');
        $query = Doc::with('user:id,avatar,nickname')
            ->whereNotNull('publish_at')
            ->whereIn('id', $docIds)
            ->get();
        $flip = array_flip($docIds->toArray());
        return $query->sortBy(function ($item, $key) use ($flip) {
            return $flip[$item->id];
        });
    }
}
