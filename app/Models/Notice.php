<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $table = 'notice';

    protected $fillable = [
        'user_id', 'content',
    ];

    public static function getUnread()
    {
        $userId = \Illuminate\Support\Facades\Auth::id();
        if ($userId) {
            return Notice::where([
                ['user_id', $userId],
                ['read', 0],
            ])->count();
        }
        return 0;
    }
}
