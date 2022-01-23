<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory('App\Models\Admin', 3)->create([
        //     'password' => bcrypt('admin'),
        // ]);
        $now = Carbon::now();
        DB::table('admin')->insert([
            'name' => 'super',
            'password' => bcrypt('super'),
            'is_super' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('admin')->insert([
            'name' => 'admin',
            'password' => bcrypt('admin'),
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('admin_role')->insert([
            'name' => 'super',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('admin_role')->insert([
            'name' => 'admin',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('admin_role_user')->insert([
            'role_id' => 1,
            'user_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('admin_role_user')->insert([
            'role_id' => 2,
            'user_id' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        foreach ([1, 2, 3, 4, 5, 6, 7, 8] as $menu_id) {
            if ($menu_id != 3) {
                DB::table('admin_role_menu')->insert([
                    'role_id' => 2,
                    'menu_id' => $menu_id,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
        DB::table('admin_permission')->insert([
            'name' => 'all',
            'http_method' => 'ANY',
            'http_path' => '*',
            'is_super' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('admin_permission')->insert([
            'name' => '后台用户',
            'http_method' => 'ANY',
            'http_path' => 'admins*',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('admin_permission')->insert([
            'name' => '后台菜单',
            'http_method' => 'ANY',
            'http_path' => 'admin_menus*',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('admin_permission')->insert([
            'name' => '后台角色',
            'http_method' => 'ANY',
            'http_path' => "admin_roles*",
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('admin_permission')->insert([
            'name' => '后台角色权限',
            'http_method' => 'GET',
            'http_path' => "admin_permissions*",
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('admin_permission')->insert([
            'name' => '分类',
            'http_method' => 'ANY',
            'http_path' => 'categories*',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('admin_permission')->insert([
            'name' => '评论',
            'http_method' => 'ANY',
            'http_path' => 'comments*',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('admin_permission')->insert([
            'name' => '文档',
            'http_method' => 'ANY',
            'http_path' => "docs*\ndocPublishs*",
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('admin_role_permission')->insert([
            'role_id' => 1,
            'permission_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        foreach ([2, 3, 4, 5, 6, 7, 8] as $permission_id) {
            DB::table('admin_role_permission')->insert([
                'role_id' => 2,
                'permission_id' => $permission_id,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
