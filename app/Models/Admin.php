<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'admin';
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password', 'deleted',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    //将密码进行加密
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * A user has and belongs to many roles.
     *
     * @return BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\AdminRole', 'admin_role_user', 'user_id', 'role_id')->withTimestamps();
    }

    public function allPermissions()
    {
        return Cache::remember('admin:permissions:' . $this->id, config('eetree.cache.ttl'), function () {
            return $this->roles()->with('permissions')->get()->pluck('permissions')->flatten()->unique(function ($item) {
                return $item->id;
            })->map(function ($item, $key) {
                return $item->only(['name', 'http_method', 'http_path']);
            });
        });
    }

    public function clearPermissions()
    {
        return Cache::forget('admin:permissions:' . $this->id);
    }

    /**
     * A user has and belongs to many menus.
     *
     * @return BelongsToMany
     */
    public function menus()
    {
        return $this->belongsToMany('App\Models\AdminRoleMenu', 'admin_role_user', 'user_id', 'role_id', 'id', 'role_id')->withTimestamps();
    }

    public function roleMenus()
    {
        $super = $this->is_super ? true : false;
        return Cache::remember('admin:menus:' . $this->id, config('eetree.cache.ttl'), function () use ($super) {
            $menuIds = $this->menus->pluck('menu_id')->toArray();
            $allMenus = config('eetree.menus');
            return $this->setMenus($allMenus, $menuIds, $super);
        });
    }

    public function clearMenus()
    {
        return Cache::forget('admin:menus:' . $this->id);
    }

    public function setMenus($menus, $menuIds, $super = false)
    {
        foreach ($menus as $key => $value) {
            if (!isset($value['id']) || $super || in_array($value['id'], $menuIds)) {
                if (isset($value['id'])) {
                    unset($menus[$key]['id']);
                }
                if (!empty($value['children'])) {
                    $menus[$key]['children'] = $this->setMenus($value['children'], $menuIds, $super);
                }
            } else {
                unset($menus[$key]);
            }
        }
        return array_values($menus);
    }
}
