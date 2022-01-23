<?php

use App\Helpers\Enums;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('zh_CN');
        $enfaker = Faker\Factory::create();
        $now = Carbon::now();

        DB::table('project')->truncate();
        DB::table('project_draft')->truncate();
        DB::table('project_team')->truncate();
        DB::table('project_team_draft')->truncate();
        DB::table('project_goods')->truncate();
        DB::table('project_goods_draft')->truncate();
        DB::table('project_cloud')->truncate();
        DB::table('project_cloud_draft')->truncate();
        DB::table('project_product')->truncate();
        DB::table('project_product_draft')->truncate();
        DB::table('tag_link')->truncate();
        DB::table('tag_link_draft')->truncate();
        DB::table('goods_trial')->truncate();
        DB::table('goods_trial_draft')->truncate();
        DB::table('platform')->truncate();
        DB::table('supplier')->truncate();
        DB::table('product')->truncate();
        DB::table('cloud')->truncate();
        DB::table('tag')->truncate();
        DB::table('recommend')->truncate();
        DB::table('order')->truncate();
        DB::table('order_item')->truncate();
        for ($i = 0; $i < 50; $i++) {
            $title = $faker->company;
            $userId = rand(1, 5);
            $description = str_repeat($faker->catchPhrase, rand(1, 60));
            $platformId = rand(1, 2);
            $projectId = DB::table('project')->insertGetId([
                'user_id' => $userId,
                'title' => $title,
                'summary' => '',
                'description' => $description,
                'rule' => '',
                'cloud_id' => 1,
                'platform_id' => $platformId,
                'first_publish_at' => $i % 2 == 0 ? $now : null,
                'last_publish_at' => $i % 2 == 0 ? $now : null,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            $draftId = DB::table('project_draft')->insertGetId([
                'user_id' => $userId,
                'project_id' => $projectId,
                'title' => $title,
                'summary' => '',
                'description' => $description,
                'rule' => '',
                'cloud_id' => 1,
                'platform_id' => $platformId,
                'submit_at' => $now,
                'status' => $i % 2 == 0 ? 9 : 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            $name = $faker->name;
            $description = str_repeat($faker->catchPhrase, rand(1, 10));
            $goodsId = DB::table('project_goods_draft')->insertGetId([
                'project_draft_id' => $draftId,
                'name' => $name,
                'description' => $description,
                'cloud_id' => rand(1, 2),
                'price' => rand(0, 1000),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            DB::table('project_goods')->insert([
                'id' => $goodsId,
                'project_id' => $projectId,
                'name' => $name,
                'description' => $description,
                'cloud_id' => rand(1, 2),
                'price' => rand(0, 1000),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            $teamId = DB::table('project_team_draft')->insertGetId([
                'project_draft_id' => $draftId,
                'name' => $name,
                'description' => $description,
                'cloud_id' => rand(1, 2),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            DB::table('project_team')->insert([
                'id' => $teamId,
                'project_id' => $projectId,
                'name' => $name,
                'description' => $description,
                'cloud_id' => rand(1, 2),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            $teamId = DB::table('tag_link_draft')->insertGetId([
                'tag_id' => rand(1, 10),
                'item_id' => $draftId,
                'item_type' => Enums::key('types.PROJECT'),
            ]);
            DB::table('tag_link')->insert([
                'tag_id' => rand(1, 10),
                'item_id' => $projectId,
                'item_type' => Enums::key('types.PROJECT'),
            ]);
            DB::table('tag_link')->insert([
                'tag_id' => rand(1, 10),
                'item_id' => $projectId,
                'item_type' => Enums::key('types.DOC'),
            ]);
            $cloudId = DB::table('project_cloud_draft')->insertGetId([
                'project_draft_id' => $draftId,
                'cloud_id' => rand(1, 2),
                'type' => rand(1, 2),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            DB::table('project_cloud')->insert([
                'id' => $cloudId,
                'project_id' => $projectId,
                'cloud_id' => rand(1, 2),
                'type' => rand(1, 2),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            $productId = DB::table('project_product_draft')->insertGetId([
                'project_draft_id' => $draftId,
                'product_id' => rand(1, 2),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            DB::table('project_product')->insert([
                'id' => $productId,
                'project_id' => $projectId,
                'product_id' => rand(1, 2),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
        DB::table('platform')->insert([[
            'name' => '树莓派',
            'order' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ], [
            'name' => 'macos',
            'order' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ], [
            'name' => 'linux',
            'order' => 3,
            'created_at' => $now,
            'updated_at' => $now,
        ]]);
        for ($i = 0; $i < 10; $i++) {
            DB::table('supplier')->insert([
                'name' => $faker->company,
                'link' => $enfaker->url,
                'cloud_id' => rand(1, 2),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            DB::table('product')->insert([
                'name' => $faker->name,
                'link' => $enfaker->url,
                'supplier_id' => rand(1, 9),
                'type' => rand(0, 2),
                'cloud_id' => rand(1, 2),
                'description' => $faker->realText,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
        DB::table('cloud')->insert([
            [
                'id' => 1,
                'fname' => '5.jpg',
                'fkey' => 'FgtAQYCUPy_kxABTXyzwhzkbHViX',
                'fsize' => 238384,
                'mime_type' => 'image/png',
                'bucket' => 'eetree',
                'storage' => 'qiniu',
            ],
            [
                'id' => 2,
                'fname' => '5.jpg',
                'fkey' => 'Fnfp9q0dRYaQlUuoxHI6GsxF5bF4',
                'fsize' => 173123,
                'mime_type' => 'image/jpeg',
                'bucket' => 'eetree',
                'storage' => 'qiniu',
            ],
        ]);
        $orderId = DB::table('order')->insertGetId([
            'order_no' => 123 + $i,
            'user_id' => 1,
            'price' => 1,
            'total_fee' => 1.23,
            'status' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('order_item')->insert([
            'order_id' => $orderId,
            'item' => 1,
            'price' => 1,
            'fee' => 1.23,
            'quantity' => 1,
        ]);
        for ($i = 0; $i < 11; $i++) {
            $trialId = DB::table('goods_trial')->insertGetId([
                'user_id' => 1,
                'order_id' => $orderId,
                'project_id' => 1,
                'goods_id' => 1,
                'title' => $faker->company,
                'cloud_id' => 1,
                'description' => str_repeat($faker->catchPhrase, rand(1, 60)),
                'publish_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            DB::table('goods_trial_draft')->insert([
                'user_id' => 1,
                'order_id' => $orderId,
                'trial_id' => $trialId,
                'project_id' => 1,
                'goods_id' => 1,
                'title' => $faker->company,
                'description' => str_repeat($faker->catchPhrase, rand(1, 60)),
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            DB::table('tag')->insert([
                'name' => 'test' . $i,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            DB::table('recommend')->insert([
                'area_id' => 5,
                'title' => 'test' . $i,
                'description' => '',
                'link' => '/tag/test' . $i,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
