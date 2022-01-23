<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\AdminRoleRequest;
use App\Http\Resources\Api\AdminRoleResource;
use App\Models\AdminRole;
use App\Models\AdminRoleMenu;
use DB;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->input('page')) {
            $roles = AdminRole::where('id', '>', 1)->paginate(config('eetree.adminLimit'));
        } else {
            $roles = AdminRole::where('id', '>', 1)->get();
        }
        return $this->success(AdminRoleResource::collection($roles));
    }

    public function show(AdminRole $role)
    {
        return $this->success(new AdminRoleResource($role));
    }

    public function delete(AdminRole $role)
    {
        DB::transaction(function () use ($role) {
            $role->permissions()->detach();
            AdminRoleMenu::where('role_id', $role->id)->delete();
            $role->admins()->detach();
            $role->delete();
        });
        return $this->success();
    }

    public function store(AdminRoleRequest $request)
    {
        $role = AdminRole::create($request->validated());
        return $this->success(new AdminRoleResource($role));
    }

    public function update(AdminRole $role, AdminRoleRequest $request)
    {
        DB::transaction(function () use ($role, $request) {
            $permissionIds = $request->input('permissions');
            $menuIds = $request->input('menus');
            $oldMenuIds = $role->menus->pluck('menu_id')->toArray();
            $role->update($request->validated());
            $role->permissions()->sync($permissionIds);
            $addMenuIds = array_diff($menuIds, $oldMenuIds);
            $delMenuIds = array_diff($oldMenuIds, $menuIds);
            if (!empty($addMenuIds)) {
                $menus = [];
                foreach ($addMenuIds as $menuId) {
                    $menus[] = new AdminRoleMenu(['menu_id' => $menuId]);
                }
                $role->menus()->saveMany($menus);
            }
            if (!empty($delMenuIds)) {
                AdminRoleMenu::where('role_id', $role->id)->whereIn('menu_id', $delMenuIds)->delete();
            }
        });
        return $this->success();
    }
}
