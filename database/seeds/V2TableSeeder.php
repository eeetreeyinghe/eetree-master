<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class V2TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        // menu
        for ($menu_id = 9; $menu_id <= 21; $menu_id++) {
            DB::table('admin_role_menu')->insert([
                'role_id' => 2,
                'menu_id' => $menu_id,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // permission
        $permissions = [
            ['项目', "projects*\nproject-drafts*\nproject-goods*\ngoods-trials*"],
            ['项目平台', "platforms*"],
            ['软硬件', "products*\nsuppliers*"],
            ['推荐内容', "recommends*"],
            ['订单', "orders*"],
            ['标签', "tags*"],
            ['基础权限', 'common*'],
            ['注册用户', 'users*'],
        ];
        foreach ($permissions as $permission) {
            $permission_id = DB::table('admin_permission')->insertGetId([
                'name' => $permission[0],
                'http_method' => 'ANY',
                'http_path' => $permission[1],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            DB::table('admin_role_permission')->insert([
                'role_id' => 2,
                'permission_id' => $permission_id,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
