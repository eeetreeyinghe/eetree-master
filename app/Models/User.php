<?php

namespace App\Models;

use App\Helpers\Enums;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mobile', 'name', 'nickname', 'password', 'user_type', 'alipay_account', 'intro',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        return $this->user_type == Enums::key('user.types.SUPER') || $this->user_type == Enums::key('user.types.ADMIN');
    }

    public function getAvatarAttribute($value)
    {
        if (strpos($value, '/') === 0) {
            $value = asset($value);
        } else if (strpos($value, 'http') !== 0) {
            $value = asset('storage/' . $value);
        }
        return $value;
    }
}
