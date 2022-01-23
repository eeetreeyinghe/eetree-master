<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Platform extends Model
{
    protected $table = 'platform';

    protected $guarded = ['id'];

    public static function allPlatforms()
    {
        return Cache::remember('platform:allPlatforms', config('eetree.cache.ttl'), function () {
            return static::select('id', 'name')->orderBy('order', 'asc')->get();
        });
    }

    public static function clear()
    {
        Cache::forget('platform:allPlatforms');
    }
}
