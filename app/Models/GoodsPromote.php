<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class GoodsPromote extends Model
{
    protected $table = 'goods_promote';

    protected $dates = ['start_at', 'end_at', 'promote_at'];

    protected $guarded = ['id'];

    public static function getPromotes($promoteUserId, $excludeIds = [], $limit = 1)
    {
        $now = Carbon::now();
        $where = [
            ['start_at', '<', $now],
            ['end_at', '>', $now],
        ];
        $promoteQuery = static::where($where)
            ->where(function ($query) {
                $query->whereRaw('threshold > pay_count')
                    ->orWhere('threshold', 0);
            });
        if (!empty($excludeIds)) {
            $promoteQuery->whereNotIn('goods_id', $excludeIds);
        }
        $promotes = $promoteQuery->select('goods_id')
            ->inRandomOrder()
            ->limit($limit)
            ->get();
        if ($promotes->isEmpty()) {
            return $promotes;
        }
        $goodsIds = $promotes->pluck('goods_id');
        $query = ProjectGoods::with('cloud')->whereIn('id', $goodsIds)->get();
        $flip = array_flip($goodsIds->toArray());
        if ($query->isNotEmpty()) {
            GoodsPromote::whereIn('goods_id', $goodsIds)->increment('view_count');
            $promoteData = [];
            foreach ($query as $item) {
                $promoteData[] = $promoteUserId . '-' . $item->id;
            }
            self::setSession($promoteData);
        }
        return $query->sortBy(function ($item, $key) use ($flip) {
            return $flip[$item->id];
        });
    }

    public static function setSession($data)
    {
        $save = session('promote.goods');
        if ($save && count($save) > 10) {
            array_splice($save, 0, 10);
        }
        if ($save) {
            session(['promote.goods' => array_unique(array_merge($save, $data))]);
        } else {
            session(['promote.goods' => $data]);
        }
    }

    public static function checkPromote($promoteUserId, $goodsId)
    {
        $save = session('promote.goods');
        return $save && in_array($promoteUserId . '-' . $goodsId, $save);
    }
}
