<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Tree;
use App\Http\Requests\Api\AdminMenuRequest;
use App\Models\AdminMenu;
use App\Models\AdminRoleMenu;
use DB;
use Illuminate\Http\Request;

class AdminMenuController extends Controller
{
    //返回菜单列表
    public function index(Request $request)
    {
        $allMenus = config('eetree.menus');
        if ($request->user()->is_super === 0) {
            foreach ($allMenus as $key => $value) {
                // unset permission menu
                if ($value['id'] === 3) {
                    unset($allMenus[$key]);
                    break;
                }
            }
        }
        return $this->success(array_values($allMenus));
        // $menus = AdminMenu::orderBy('order', 'asc')->get();
        // $menus = Tree::make($menus);
        // return $this->success(AdminMenuResource::collection($menus));
    }

    //删除菜单
    public function delete(AdminMenu $menu)
    {
        $all = AdminMenu::orderBy('order', 'asc')->get();
        $all = Tree::make($all);
        $subTree = Tree::children($all, $menu->id);
        $deleteIds = Tree::ids($subTree);
        $siblings = Tree::siblings($all, $menu);
        $deleteIds[] = $menu->id;
        DB::transaction(function () use ($siblings, $deleteIds) {
            //TODO update batch
            $siblings->each(function ($item, $key) {
                if ($item->order != $key) {
                    AdminMenu::where('id', $item->id)->update(['order' => $key]);
                }
            });
            AdminRoleMenu::whereIn('menu_id', $deleteIds)->delete();
            AdminMenu::whereIn('id', $deleteIds)->delete();
        });

        return $this->success();
    }

    public function store(AdminMenuRequest $request)
    {
        $data = $request->validated();
        $data['order'] = AdminMenu::where('parent_id', $data['parent_id'])->count();
        AdminMenu::create($data);
        return $this->created();
    }

    public function update(AdminMenu $menu, AdminMenuRequest $request)
    {
        $data = $request->validated();
        $menu->update($data);
        return $this->success();
    }
}
