<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EetreeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('zh_CN');
        $now = Carbon::now();
        // DB::table('admin_role_menu')->truncate();
        // foreach ([1, 2, 3, 4, 5, 6] as $menu_id) {
        //     DB::table('admin_role_menu')->insert([
        //         'role_id' => 1,
        //         'menu_id' => $menu_id,
        //         'created_at' => $now,
        //         'updated_at' => $now,
        //     ]);
        // }
        // return;
        DB::table('category')->truncate();
        DB::table('user_category')->truncate();
        DB::table('user')->truncate();
        DB::table('doc_publish')->truncate();
        DB::table('doc_draft')->truncate();
        DB::table('doc')->truncate();
        DB::table('favorite')->truncate();
        DB::table('doc_category')->truncate();
        DB::table('comment')->truncate();
        DB::table('notice')->truncate();
        $status = [1, 8, 9];
        // for ($i = 0; $i < 50; $i++) {
        //     DB::table('doc_draft')->insert([
        //         'title' => $faker->title,
        //         'content' => $faker->text,
        //         'user_id' => rand(1, 49),
        //         'doc_id' => rand(1, 49),
        //         'user_category_id' => rand(1, 3),
        //         'status' => $status[rand(0, 3)],
        //         'review_remarks' => '',
        //         'created_at' => $now,
        //         'updated_at' => $now,
        //     ]);
        // }
        // return;
        DB::table('category')->insert([
            'parent_id' => 0,
            'order' => 0,
            'name' => '分类1',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('category')->insert([
            'parent_id' => 1,
            'order' => 0,
            'name' => '分类1-1',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('category')->insert([
            'parent_id' => 1,
            'order' => 1,
            'name' => '分类1-2',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('category')->insert([
            'parent_id' => 0,
            'order' => 1,
            'name' => '分类2',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('category')->insert([
            'parent_id' => 0,
            'order' => 2,
            'name' => '分类3',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('user_category')->insert([
            'parent_id' => 0,
            'user_id' => 1,
            'order' => 0,
            'name' => '分类1',
            'last_edit_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('user_category')->insert([
            'parent_id' => 1,
            'user_id' => 1,
            'order' => 0,
            'name' => '分类1-1',
            'last_edit_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('user_category')->insert([
            'parent_id' => 1,
            'user_id' => 1,
            'order' => 1,
            'name' => '分类1-2',
            'last_edit_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('user_category')->insert([
            'parent_id' => 0,
            'user_id' => 1,
            'order' => 1,
            'name' => '分类2',
            'last_edit_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('user_category')->insert([
            'parent_id' => 0,
            'user_id' => 1,
            'order' => 2,
            'name' => '分类3',
            'last_edit_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        for ($i = 0; $i < 50; $i++) {
            DB::table('user')->insert([
                'name' => $faker->userName,
                'nickname' => $faker->name,
                'password' => bcrypt('test'),
                'mobile' => 13451234000 + $i,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            $title = $faker->company;
            $description = str_repeat($faker->catchPhrase, rand(1, 3));
            DB::table('doc_publish')->insert([
                'title' => $title,
                'description' => $description,
                'content' => $i === 0 ? '{"root":{"data":{"id":"btxlk2q7ng00","created":"1557279632127","text":"\u6d4b\u8bd5\u4e00\u4e0b"},"children":[{"data":{"id":"btyqiod7qa80","created":1557395188007,"text":"\u70b9\u6211\u6d4b\u8bd5\u94fe\u63a5","hyperlink":"http:\/\/www.eelib.io","hyperlinkTitle":"\u7535\u5b50\u68ee\u6797"},"children":[{"data":{"id":"btyqiu4onyw0","created":1557395200552,"text":"depth2-1"},"children":[{"data":{"id":"btyqj25cl280","created":1557395218007,"text":"depth3 - 1"},"children":[]},{"data":{"id":"btyqjdx0kg00","created":1557395243624,"text":"depth3-2"},"children":[]}]},{"data":{"id":"btyqiv1ujjc0","created":1557395202558,"text":"depth2-2"},"children":[]},{"data":{"id":"btyqjgynq1c0","created":1557395250254,"text":"depth2-3"},"children":[]},{"data":{"id":"bu32unn3wdk0","created":1557836219944,"text":"\u6d4b\u8bd5\u56fe\u7247","image":"http:\/\/img1.imgtn.bdimg.com\/it\/u=3030642356,2321064273&fm=26&gp=0.jpg","imageTitle":"give a hand to wildlife \u5f69\u7ed8\u5927\u8c61\u7bc7 - wwf\u52a8\u7269\u4fdd\u62a4\u516c\u76ca","imageSize":{"width":200,"height":150}},"children":[]}]},{"data":{"id":"btyqisdob8o0","created":1557395196742,"text":"\u6d4b\u8bd5\u5907\u6ce8","note":"# \u8fd9\u662f\u4e00\u7ea7\u6807\u9898\uff08\u4f1a\u751f\u6210<h1>\u6807\u7b7e\uff09\n\n## \u8fd9\u91cc\u662f\u4e8c\u7ea7\u6807\u9898\uff08\u4f1a\u751f\u6210<h2>\u6807\u7b7e\uff09\n\n> To be or not to be, that is a question.\n\n###### \u8fd9\u91cc\u662f\u516d\u7ea7\u6807\u9898\n\n\u52a0\u7c97\u4f7f\u7528: **\u8fd9\u79cd\u8bed\u6cd5**\n\u659c\u4f53\u4f7f\u7528: *\u8fd9\u79cd\u8bed\u6cd5* \u6216 _\u8fd9\u79cd\u8bed\u6cd5_\n\u8fd8\u53ef\u4ee5\u6df7\u5408\u4f7f\u7528\uff1a**\u52a0\u7c97\u6587\u672c\u4e2d\u7684_\u659c\u4f53_**\n\n\u8fd9\u6837\u6765~~\u5220\u9664\u4e00\u6bb5\u6587\u672c~~\n\n[eelib](https:\/\/www.eelib.io) - \u63a7\u5236\u521b\u610f\uff0c\u5982\u6b64\u7b80\u5355\n\n1. \u6253\u5f00\u51b0\u7bb1\n  1. \u7528\u53f3\u624b\u6253\u5f00\n  2. \u8f7b\u8f7b\u5730\u6253\u5f00\n2. \u628a\u5927\u8c61\u653e\u8fdb\u53bb\n  * \u4e0d\u8981\u5410\u69fd\n    * \u5927\u8c61\u592a\u5927\n    * \u51b0\u7bb1\u592a\u5c0f\n    * \u4f8b\u5b50\u5f88\u65e0\u804a\n3. \u5173\u4e0a\u51b0\u7bb1\n\n\u6708\u4efd|\u6536\u5165|\u652f\u51fa\n----|----|---\n8   |1000|500\n9   |1200|600\n10  |1400|650\n\n ```\n var a = 0;\n var b = 1;\n var c = a + b;\n ```"},"children":[]}]},"template":"default","theme":"fresh-blue","version":"1.4.43"}'
                : '{"root":{"data":{"id":"buprp7dvbrc0","created":1560140639531,"text":"\u65b0\u5efa\u6587\u6863"},"children":[]},"template":"default","theme":"fresh-blue","version":"1.4.43"}',
                'user_id' => 1,
                'doc_id' => $i + 1,
                'status' => $status[rand(0, 2)],
                'review_remarks' => $description,
                'submit_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            DB::table('doc_draft')->insert([
                'title' => $title,
                'content' => $i === 0 ? '{"root":{"data":{"id":"btxlk2q7ng00","created":"1557279632127","text":"\u6d4b\u8bd5\u4e00\u4e0b"},"children":[{"data":{"id":"btyqiod7qa80","created":1557395188007,"text":"\u70b9\u6211\u6d4b\u8bd5\u94fe\u63a5","hyperlink":"http:\/\/www.eelib.io","hyperlinkTitle":"\u7535\u5b50\u68ee\u6797"},"children":[{"data":{"id":"btyqiu4onyw0","created":1557395200552,"text":"depth2-1"},"children":[{"data":{"id":"btyqj25cl280","created":1557395218007,"text":"depth3 - 1"},"children":[]},{"data":{"id":"btyqjdx0kg00","created":1557395243624,"text":"depth3-2"},"children":[]}]},{"data":{"id":"btyqiv1ujjc0","created":1557395202558,"text":"depth2-2"},"children":[]},{"data":{"id":"btyqjgynq1c0","created":1557395250254,"text":"depth2-3"},"children":[]},{"data":{"id":"bu32unn3wdk0","created":1557836219944,"text":"\u6d4b\u8bd5\u56fe\u7247","image":"http:\/\/img1.imgtn.bdimg.com\/it\/u=3030642356,2321064273&fm=26&gp=0.jpg","imageTitle":"give a hand to wildlife \u5f69\u7ed8\u5927\u8c61\u7bc7 - wwf\u52a8\u7269\u4fdd\u62a4\u516c\u76ca","imageSize":{"width":200,"height":150}},"children":[]}]},{"data":{"id":"btyqisdob8o0","created":1557395196742,"text":"\u6d4b\u8bd5\u5907\u6ce8","note":"# \u8fd9\u662f\u4e00\u7ea7\u6807\u9898\uff08\u4f1a\u751f\u6210<h1>\u6807\u7b7e\uff09\n\n## \u8fd9\u91cc\u662f\u4e8c\u7ea7\u6807\u9898\uff08\u4f1a\u751f\u6210<h2>\u6807\u7b7e\uff09\n\n> To be or not to be, that is a question.\n\n###### \u8fd9\u91cc\u662f\u516d\u7ea7\u6807\u9898\n\n\u52a0\u7c97\u4f7f\u7528: **\u8fd9\u79cd\u8bed\u6cd5**\n\u659c\u4f53\u4f7f\u7528: *\u8fd9\u79cd\u8bed\u6cd5* \u6216 _\u8fd9\u79cd\u8bed\u6cd5_\n\u8fd8\u53ef\u4ee5\u6df7\u5408\u4f7f\u7528\uff1a**\u52a0\u7c97\u6587\u672c\u4e2d\u7684_\u659c\u4f53_**\n\n\u8fd9\u6837\u6765~~\u5220\u9664\u4e00\u6bb5\u6587\u672c~~\n\n[eelib](https:\/\/www.eelib.io) - \u63a7\u5236\u521b\u610f\uff0c\u5982\u6b64\u7b80\u5355\n\n1. \u6253\u5f00\u51b0\u7bb1\n  1. \u7528\u53f3\u624b\u6253\u5f00\n  2. \u8f7b\u8f7b\u5730\u6253\u5f00\n2. \u628a\u5927\u8c61\u653e\u8fdb\u53bb\n  * \u4e0d\u8981\u5410\u69fd\n    * \u5927\u8c61\u592a\u5927\n    * \u51b0\u7bb1\u592a\u5c0f\n    * \u4f8b\u5b50\u5f88\u65e0\u804a\n3. \u5173\u4e0a\u51b0\u7bb1\n\n\u6708\u4efd|\u6536\u5165|\u652f\u51fa\n----|----|---\n8   |1000|500\n9   |1200|600\n10  |1400|650\n\n ```\n var a = 0;\n var b = 1;\n var c = a + b;\n ```"},"children":[]}]},"template":"default","theme":"fresh-blue","version":"1.4.43"}'
                : '{"root":{"data":{"id":"buprp7dvbrc0","created":1560140639531,"text":"\u65b0\u5efa\u6587\u6863"},"children":[]},"template":"default","theme":"fresh-blue","version":"1.4.43"}',
                'user_id' => 1,
                'doc_id' => $i + 1,
                'share_id' => 'share',
                'publish_id' => $i + 1,
                'user_category_id' => rand(1, 5),
                'last_edit_at' => $now,
                'shared_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            $doc_id = DB::table('doc')->insertGetId([
                'user_id' => 1,
                'title' => $title,
                'description' => $description,
                'content' => $i === 0 ? '{"root":{"data":{"id":"btxlk2q7ng00","created":"1557279632127","text":"\u6d4b\u8bd5\u4e00\u4e0b"},"children":[{"data":{"id":"btyqiod7qa80","created":1557395188007,"text":"\u70b9\u6211\u6d4b\u8bd5\u94fe\u63a5","hyperlink":"http:\/\/www.eelib.io","hyperlinkTitle":"\u7535\u5b50\u68ee\u6797"},"children":[{"data":{"id":"btyqiu4onyw0","created":1557395200552,"text":"depth2-1"},"children":[{"data":{"id":"btyqj25cl280","created":1557395218007,"text":"depth3 - 1"},"children":[]},{"data":{"id":"btyqjdx0kg00","created":1557395243624,"text":"depth3-2"},"children":[]}]},{"data":{"id":"btyqiv1ujjc0","created":1557395202558,"text":"depth2-2"},"children":[]},{"data":{"id":"btyqjgynq1c0","created":1557395250254,"text":"depth2-3"},"children":[]},{"data":{"id":"bu32unn3wdk0","created":1557836219944,"text":"\u6d4b\u8bd5\u56fe\u7247","image":"http:\/\/img1.imgtn.bdimg.com\/it\/u=3030642356,2321064273&fm=26&gp=0.jpg","imageTitle":"give a hand to wildlife \u5f69\u7ed8\u5927\u8c61\u7bc7 - wwf\u52a8\u7269\u4fdd\u62a4\u516c\u76ca","imageSize":{"width":200,"height":150}},"children":[]}]},{"data":{"id":"btyqisdob8o0","created":1557395196742,"text":"\u6d4b\u8bd5\u5907\u6ce8","note":"# \u8fd9\u662f\u4e00\u7ea7\u6807\u9898\uff08\u4f1a\u751f\u6210<h1>\u6807\u7b7e\uff09\n\n## \u8fd9\u91cc\u662f\u4e8c\u7ea7\u6807\u9898\uff08\u4f1a\u751f\u6210<h2>\u6807\u7b7e\uff09\n\n> To be or not to be, that is a question.\n\n###### \u8fd9\u91cc\u662f\u516d\u7ea7\u6807\u9898\n\n\u52a0\u7c97\u4f7f\u7528: **\u8fd9\u79cd\u8bed\u6cd5**\n\u659c\u4f53\u4f7f\u7528: *\u8fd9\u79cd\u8bed\u6cd5* \u6216 _\u8fd9\u79cd\u8bed\u6cd5_\n\u8fd8\u53ef\u4ee5\u6df7\u5408\u4f7f\u7528\uff1a**\u52a0\u7c97\u6587\u672c\u4e2d\u7684_\u659c\u4f53_**\n\n\u8fd9\u6837\u6765~~\u5220\u9664\u4e00\u6bb5\u6587\u672c~~\n\n[eelib](https:\/\/www.eelib.io) - \u63a7\u5236\u521b\u610f\uff0c\u5982\u6b64\u7b80\u5355\n\n1. \u6253\u5f00\u51b0\u7bb1\n  1. \u7528\u53f3\u624b\u6253\u5f00\n  2. \u8f7b\u8f7b\u5730\u6253\u5f00\n2. \u628a\u5927\u8c61\u653e\u8fdb\u53bb\n  * \u4e0d\u8981\u5410\u69fd\n    * \u5927\u8c61\u592a\u5927\n    * \u51b0\u7bb1\u592a\u5c0f\n    * \u4f8b\u5b50\u5f88\u65e0\u804a\n3. \u5173\u4e0a\u51b0\u7bb1\n\n\u6708\u4efd|\u6536\u5165|\u652f\u51fa\n----|----|---\n8   |1000|500\n9   |1200|600\n10  |1400|650\n\n ```\n var a = 0;\n var b = 1;\n var c = a + b;\n ```"},"children":[]}]},"template":"default","theme":"fresh-blue","version":"1.4.43"}'
                : '{"root":{"data":{"id":"buprp7dvbrc0","created":1560140639531,"text":"\u65b0\u5efa\u6587\u6863"},"children":[]},"template":"default","theme":"fresh-blue","version":"1.4.43"}',
                'parsed_content' => $i === 0 ? '{"root":{"data":{"id":"btxlk2q7ng00","created":"1557279632127","text":"\u6d4b\u8bd5\u4e00\u4e0b"},"children":[{"data":{"id":"btyqiod7qa80","created":1557395188007,"text":"\u70b9\u6211\u6d4b\u8bd5\u94fe\u63a5","hyperlink":"http:\/\/www.eelib.io","hyperlinkTitle":"\u7535\u5b50\u68ee\u6797"},"children":[{"data":{"id":"btyqiu4onyw0","created":1557395200552,"text":"depth2-1"},"children":[{"data":{"id":"btyqj25cl280","created":1557395218007,"text":"depth3 - 1"},"children":[]},{"data":{"id":"btyqjdx0kg00","created":1557395243624,"text":"depth3-2"},"children":[]}]},{"data":{"id":"btyqiv1ujjc0","created":1557395202558,"text":"depth2-2"},"children":[]},{"data":{"id":"btyqjgynq1c0","created":1557395250254,"text":"depth2-3"},"children":[]},{"data":{"id":"bu32unn3wdk0","created":1557836219944,"text":"\u6d4b\u8bd5\u56fe\u7247","image":"http:\/\/img1.imgtn.bdimg.com\/it\/u=3030642356,2321064273&fm=26&gp=0.jpg","imageTitle":"give a hand to wildlife \u5f69\u7ed8\u5927\u8c61\u7bc7 - wwf\u52a8\u7269\u4fdd\u62a4\u516c\u76ca","imageSize":{"width":200,"height":150}},"children":[]}]},{"data":{"id":"btyqisdob8o0","created":1557395196742,"text":"\u6d4b\u8bd5\u5907\u6ce8","note":"# \u8fd9\u662f\u4e00\u7ea7\u6807\u9898\uff08\u4f1a\u751f\u6210<h1>\u6807\u7b7e\uff09\n\n## \u8fd9\u91cc\u662f\u4e8c\u7ea7\u6807\u9898\uff08\u4f1a\u751f\u6210<h2>\u6807\u7b7e\uff09\n\n> To be or not to be, that is a question.\n\n###### \u8fd9\u91cc\u662f\u516d\u7ea7\u6807\u9898\n\n\u52a0\u7c97\u4f7f\u7528: **\u8fd9\u79cd\u8bed\u6cd5**\n\u659c\u4f53\u4f7f\u7528: *\u8fd9\u79cd\u8bed\u6cd5* \u6216 _\u8fd9\u79cd\u8bed\u6cd5_\n\u8fd8\u53ef\u4ee5\u6df7\u5408\u4f7f\u7528\uff1a**\u52a0\u7c97\u6587\u672c\u4e2d\u7684_\u659c\u4f53_**\n\n\u8fd9\u6837\u6765~~\u5220\u9664\u4e00\u6bb5\u6587\u672c~~\n\n[eelib](https:\/\/www.eelib.io) - \u63a7\u5236\u521b\u610f\uff0c\u5982\u6b64\u7b80\u5355\n\n1. \u6253\u5f00\u51b0\u7bb1\n  1. \u7528\u53f3\u624b\u6253\u5f00\n  2. \u8f7b\u8f7b\u5730\u6253\u5f00\n2. \u628a\u5927\u8c61\u653e\u8fdb\u53bb\n  * \u4e0d\u8981\u5410\u69fd\n    * \u5927\u8c61\u592a\u5927\n    * \u51b0\u7bb1\u592a\u5c0f\n    * \u4f8b\u5b50\u5f88\u65e0\u804a\n3. \u5173\u4e0a\u51b0\u7bb1\n\n\u6708\u4efd|\u6536\u5165|\u652f\u51fa\n----|----|---\n8   |1000|500\n9   |1200|600\n10  |1400|650\n\n ```\n var a = 0;\n var b = 1;\n var c = a + b;\n ```"},"children":[]}]},"template":"default","theme":"fresh-blue","version":"1.4.43"}'
                : '{"root":{"data":{"id":"buprp7dvbrc0","created":1560140639531,"text":"\u65b0\u5efa\u6587\u6863"},"children":[]},"template":"default","theme":"fresh-blue","version":"1.4.43"}',
                'publish_at' => $now,
                'view_count' => rand(1, 100),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            DB::table('favorite')->insert([
                'user_id' => 1,
                'fav_id' => $i + 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            DB::table('doc_category')->insert([
                'doc_id' => $doc_id,
                'category_id' => rand(1, 5),
            ]);
            $reply_num = 0;
            if ($i === 0) {
                $reply_num = 13;
            }
            if ($i === 1) {
                $reply_num = 11;
            }
            DB::table('comment')->insert([
                'user_id' => $i === 0 || $i === 1 ? 2 : rand(1, 50),
                'item' => 1,
                'content' => str_repeat($faker->catchPhrase, rand(1, 60)),
                'active' => 1,
                'reply_num' => $reply_num,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
        $commentId = DB::table('comment')->insertGetId([
            'user_id' => 3,
            'item' => 1,
            'comment_id' => 1,
            'target_id' => 1,
            'target_user_id' => 2,
            'content' => str_repeat($faker->catchPhrase, rand(1, 60)),
            'active' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('comment')->insert([
            'user_id' => 4,
            'item' => 1,
            'comment_id' => 1,
            'target_id' => $commentId,
            'target_user_id' => 3,
            'content' => str_repeat($faker->catchPhrase, rand(1, 60)),
            'active' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        for ($i = 0; $i < 11; $i++) {
            DB::table('comment')->insert([
                'user_id' => rand(2, 50),
                'item' => 1,
                'comment_id' => 1,
                'target_id' => 1,
                'target_user_id' => 2,
                'content' => str_repeat($faker->catchPhrase, rand(1, 60)),
                'active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            DB::table('comment')->insert([
                'user_id' => rand(2, 50),
                'item' => 1,
                'comment_id' => 2,
                'target_id' => 2,
                'target_user_id' => 2,
                'content' => str_repeat($faker->catchPhrase, rand(1, 60)),
                'active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            DB::table('notice')->insert([
                'user_id' => 1,
                'content' => '您提交的文档《诺依曼软件科技有限公司》已通过审核，请点击<a href="http://eetree.test/doc/detail/3">此处</a>查看',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            DB::table('notice')->insert([
                'user_id' => 1,
                'content' => '您提交的文档《迪摩科技有限公司》审核未通过，请<a href="http://eetree.test/doc/edit/7">修改</a>后重新提交。<br />原因：' . str_repeat($faker->catchPhrase, rand(1, 60)),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
