<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0);
            $table->decimal('user_ratio', 2, 2)->nullable();
            $table->string('title', 100);
            $table->string('summary', 1000);
            $table->mediumText('description');
            $table->text('rule');
            $table->tinyInteger('has_agreement')->default(0);
            $table->string('agreement', 5000)->nullable();
            $table->string('video_code')->nullable();
            $table->integer('cloud_id')->default(0);
            $table->tinyInteger('type')->default(0);
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->integer('platform_id')->default(0);
            $table->string('team_intro', 1000)->nullable();
            $table->tinyInteger('promote')->default(0)->comment('0:默认,1:参与推广');
            $table->integer('view_count')->default(0);
            $table->integer('fav_count')->default(0);
            $table->integer('like_count')->default(0);
            $table->integer('schedule_count')->default(0);
            $table->integer('backers')->default(0)->comment('购买人数');
            $table->decimal('fund_goal', 10, 2)->default(0)->comment('众筹资金目标');
            $table->decimal('fund_crowd', 10, 2)->default(0)->comment('已达成资金');
            $table->timestamp('first_publish_at')->nullable();
            $table->timestamp('last_publish_at')->nullable();
            $table->integer('pid')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('project_draft', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0);
            $table->integer('project_id')->default(0);
            $table->string('title', 100);
            $table->string('summary', 1000)->default('');
            $table->mediumText('description');
            $table->text('rule');
            $table->tinyInteger('has_agreement')->default(0);
            $table->string('agreement', 5000)->nullable();
            $table->string('video_code')->nullable();
            $table->integer('cloud_id')->default(0);
            $table->tinyInteger('type')->default(0);
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->decimal('fund_goal', 10, 2)->default(0)->comment('众筹资金目标');
            $table->integer('platform_id')->default(0);
            $table->string('team_intro', 1000)->nullable();
            $table->tinyInteger('promote')->default(0)->comment('0:默认,1:参与推广');
            $table->tinyInteger('status')->default(0)->comment('0:草稿,1:提交审核,8:审核不通过,9:审核通过');
            $table->string('review_remarks', 2000)->default('')->comment('审核不通过的原因');
            $table->timestamp('submit_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('project_team', function (Blueprint $table) {
            $table->integer('id')->default(0);
            $table->integer('project_id')->default(0);
            $table->integer('user_id')->default(0);
            $table->string('name', 100);
            $table->integer('cloud_id')->default(0);
            $table->text('description');

            $table->timestamps();
            $table->primary('id');
        });
        Schema::create('project_team_draft', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_draft_id')->default(0);
            $table->integer('user_id')->default(0);
            $table->string('name', 100);
            $table->integer('cloud_id')->default(0);
            $table->text('description');

            $table->timestamps();
        });
        Schema::create('project_schedule', function (Blueprint $table) {
            $table->integer('id')->default(0);
            $table->integer('project_id')->default(0);
            $table->string('title', 100);
            $table->string('video_code')->nullable();
            $table->text('description');
            $table->timestamp('submit_at')->nullable();

            $table->timestamps();
            $table->primary('id');
        });
        Schema::create('project_schedule_draft', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_draft_id')->default(0);
            $table->string('title', 100);
            $table->string('video_code')->nullable();
            $table->text('description');
            $table->timestamp('submit_at')->nullable();

            $table->timestamps();
        });
        Schema::create('project_goods', function (Blueprint $table) {
            $table->integer('id')->default(0);
            $table->integer('project_id')->default(0);
            $table->string('name', 255);
            $table->text('description');
            $table->integer('cloud_id')->default(0);
            $table->decimal('price', 10, 2);
            $table->string('link', 255)->nullable();
            $table->integer('xform_id')->default(0);

            $table->timestamps();
            $table->softDeletes();
            $table->primary('id');
        });
        Schema::create('project_goods_draft', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_draft_id')->default(0);
            $table->string('name', 255);
            $table->text('description');
            $table->integer('cloud_id')->default(0);
            $table->decimal('price', 10, 2);
            $table->string('link', 255)->nullable();

            $table->timestamps();
        });
        Schema::create('project_case', function (Blueprint $table) {
            $table->integer('id')->default(0);
            $table->integer('project_id')->default(0);
            $table->string('title', 50);
            $table->string('description', 2000)->nullable();
            $table->string('link', 255)->nullable();
            $table->integer('cloud_id')->default(0);
            $table->integer('order')->default(0);

            $table->timestamps();
            $table->softDeletes();
            $table->primary('id');
        });
        Schema::create('project_case_draft', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_draft_id')->default(0);
            $table->string('title', 50);
            $table->string('description', 2000)->nullable();
            $table->string('link', 255)->nullable();
            $table->integer('cloud_id')->default(0);
            $table->integer('order')->default(0);

            $table->timestamps();
        });
        Schema::create('project_course', function (Blueprint $table) {
            $table->integer('id')->default(0);
            $table->integer('project_id')->default(0);
            $table->string('title', 50);
            $table->string('description', 2000)->nullable();
            $table->string('link', 255)->nullable();
            $table->integer('cloud_id')->default(0);

            $table->timestamps();
            $table->softDeletes();
            $table->primary('id');
        });
        Schema::create('project_course_draft', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_draft_id')->default(0);
            $table->string('title', 50);
            $table->string('description', 2000)->nullable();
            $table->string('link', 255)->nullable();
            $table->integer('cloud_id')->default(0);

            $table->timestamps();
        });
        Schema::create('project_cloud', function (Blueprint $table) {
            $table->integer('id')->default(0);
            $table->integer('project_id')->default(0);
            $table->integer('cloud_id')->default(0);
            $table->tinyInteger('type')->default(0)->comment('0:电路图,1:附件');
            $table->string('description', 2000)->nullable();

            $table->timestamps();
            $table->primary('id');
        });
        Schema::create('project_cloud_draft', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_draft_id')->default(0);
            $table->integer('cloud_id')->default(0);
            $table->tinyInteger('type')->default(0)->comment('0:电路图,1:附件');
            $table->string('description', 2000)->nullable();

            $table->timestamps();
        });
        Schema::create('project_product', function (Blueprint $table) {
            $table->integer('id')->default(0);
            $table->integer('project_id')->default(0);
            $table->integer('product_id')->default(0);
            $table->text('data')->nullable();

            $table->timestamps();
            $table->primary('id');
        });
        Schema::create('project_product_draft', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_draft_id')->default(0);
            $table->integer('product_id')->default(0);
            $table->text('data')->nullable();

            $table->timestamps();
        });
        Schema::create('project_relate', function (Blueprint $table) {
            $table->integer('id')->default(0);
            $table->integer('project_id')->default(0);
            $table->integer('relate_id')->default(0);

            $table->timestamps();
            $table->primary('id');
        });
        Schema::create('project_relate_draft', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_draft_id')->default(0);
            $table->integer('relate_id')->default(0);

            $table->timestamps();
        });
        Schema::create('goods_trial', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('project_id')->default(0);
            $table->integer('goods_id')->default(0);
            $table->integer('user_id')->default(0);
            $table->string('title', 255);
            $table->integer('cloud_id')->default(0);
            $table->text('description');
            $table->integer('attachment_id')->default(0);
            $table->timestamp('publish_at')->nullable();

            $table->timestamps();
        });
        Schema::create('goods_trial_draft', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trial_id')->default(0);
            $table->integer('order_id');
            $table->integer('project_id')->default(0);
            $table->integer('goods_id')->default(0);
            $table->integer('user_id')->default(0);
            $table->string('title', 255);
            $table->integer('cloud_id')->default(0);
            $table->text('description');
            $table->integer('attachment_id')->default(0);
            $table->tinyInteger('status')->default(0)->comment('0:草稿,1:提交审核,8:审核不通过,9:审核通过');
            $table->string('review_remarks', 2000)->default('')->comment('审核不通过的原因');
            $table->timestamp('submit_at')->nullable();

            $table->timestamps();
        });
        Schema::create('project_top', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('top_id')->default(0);
            $table->integer('threshold')->default(0);
            $table->integer('view_count')->default(0);
            $table->integer('click_count')->default(0);
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->tinyInteger('is_top')->default(0);
            $table->timestamp('toped_at')->nullable();

            $table->timestamps();

            $table->index('top_id');
        });
        Schema::create('goods_promote', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('goods_id')->default(0)->unique();
            $table->integer('threshold')->default(0);
            $table->integer('view_count')->default(0);
            $table->integer('pay_count')->default(0);
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->timestamp('promote_at')->nullable();

            $table->timestamps();
        });
        Schema::create('cloud', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname', 255);
            $table->string('fkey', 255);
            $table->integer('user_id')->default(0);
            $table->integer('fsize');
            $table->string('mime_type', 300);
            $table->string('bucket', 16);
            $table->string('storage', 16);

            $table->timestamps();
            $table->unique(['fkey', 'bucket', 'storage']);
        });
        Schema::create('platform', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('link', 255)->nullable();
            $table->integer('order')->default(0);

            $table->timestamps();
        });
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('type')->default(0)->comment('0:硬件,1:软件,2:工具');
            $table->integer('supplier_id')->default(0);
            $table->string('name', 50);
            $table->string('description', 2000)->nullable();
            $table->string('link', 255)->nullable();
            $table->integer('cloud_id')->default(0);

            $table->timestamps();
        });
        Schema::create('supplier', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('link', 255)->nullable();
            $table->integer('cloud_id')->default(0);

            $table->timestamps();
        });
        Schema::create('address', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0);
            $table->string('name');
            $table->string('mobile', 32);
            $table->string('province', 16);
            $table->string('city', 16);
            $table->string('district', 16);
            $table->string('address');
            $table->string('postcode', 16)->nullable();
            $table->tinyInteger('default')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_no', 32)->unique();
            $table->integer('user_id')->default(0);
            $table->decimal('price', 10, 2);
            $table->decimal('total_fee', 10, 2);
            $table->tinyInteger('status')->default(0)->comment('0:新建,1:提交,2:完成,3:失败');
            $table->tinyInteger('job')->default(0)->comment('0:任务未处理，1:任务已处理');
            $table->timestamp('paid_at')->nullable();
            $table->string('name')->nullable();
            $table->string('mobile', 32)->nullable();
            $table->string('address')->nullable();
            $table->string('postcode', 16)->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('order_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->default(0);
            $table->integer('promote_user')->default(0)->comment('推广者ID');
            $table->integer('pitem')->default(0);
            $table->integer('item');
            $table->string('item_name')->default('');
            $table->decimal('price', 10, 2);
            $table->decimal('fee', 10, 2);
            $table->integer('quantity');
        });
        Schema::create('pay_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->string('out_trade_no', 32)->unique();
            $table->string('method', 32);
            $table->string('sub_method', 32);
            $table->decimal('total_fee', 10, 2);
            $table->tinyInteger('status')->default(0)->comment('2:完成,3:失败');
            $table->text('data');

            $table->timestamps();
        });
        Schema::create('revenue_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('item_id');
            $table->decimal('fee', 10, 2);
            $table->decimal('revenue', 10, 2);
            $table->timestamp('paid_at')->nullable();
            $table->tinyInteger('type')->default(0)->comment('0:正常收入，1:推广分成');

            $table->timestamps();

            $table->index('paid_at');
        });
        Schema::create('recommend', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('area_id')->default(0);
            $table->tinyInteger('obj_type')->default(-1)->comment('0:doc,1:project');
            $table->integer('obj_id')->default(0);
            $table->string('title', 255);
            $table->string('description', 2000)->nullable();
            $table->string('link', 255)->nullable();
            $table->integer('cloud_id')->default(0);
            $table->integer('order')->default(0);

            $table->timestamps();

            $table->index('area_id');
        });
        Schema::create('tag', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->tinyInteger('type')->default(0)->comment('0:默认,1:标准（后台添加或归类后）');
            $table->integer('pid')->default(0);

            $table->timestamps();

            $table->unique('name');
        });
        Schema::create('tag_link', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tag_id');
            $table->integer('item_id');
            $table->tinyInteger('item_type')->default(0)->comment('0:doc,1:project');

            $table->unique(['tag_id', 'item_id', 'item_type']);
        });
        Schema::create('tag_link_draft', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tag_id');
            $table->integer('item_id');
            $table->tinyInteger('item_type')->default(0)->comment('0:doc,1:project');

            $table->unique(['tag_id', 'item_id', 'item_type']);
        });
        Schema::create('cron_rec', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key', 32)->unique();
            $table->string('value')->nullable();

            $table->timestamps();
        });
        Schema::create('xform', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->text('data');

            $table->timestamps();
        });
        Schema::create('xform_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('xform_id')->default(0);
            $table->integer('user_id')->default(0);
            $table->text('data');

            $table->timestamps();
        });

        Schema::table('doc_publish', function (Blueprint $table) {
            $table->string('tags')->default('[]')->after('type');
        });
        Schema::table('comment', function (Blueprint $table) {
            $table->tinyInteger('type')->default(0)->comment('0:doc,1:project')->after('id');
            $table->renameColumn('doc_id', 'item');
            $table->softDeletes();
        });
        Schema::table('likes', function (Blueprint $table) {
            $table->tinyInteger('type')->default(0)->comment('0:doc,1:project')->after('id');
        });
        Schema::table('favorite', function (Blueprint $table) {
            $table->tinyInteger('type')->default(0)->comment('0:doc,1:project')->after('id');
        });
        Schema::table('user', function (Blueprint $table) {
            $table->integer('pj_like_count')->default(0)->after('like_count');
            $table->integer('pj_fav_count')->default(0)->after('fav_count');
            $table->string('alipay_account')->nullable();
            $table->string('intro')->nullable();
            $table->decimal('promote_revenue', 10, 2)->default(0)->comment('推广分成')->after('avatar');
            $table->decimal('revenue', 10, 2)->default(0)->comment('总收入')->after('avatar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project');
        Schema::dropIfExists('project_draft');
        Schema::dropIfExists('project_team');
        Schema::dropIfExists('project_team_draft');
        Schema::dropIfExists('project_schedule');
        Schema::dropIfExists('project_schedule_draft');
        Schema::dropIfExists('project_goods');
        Schema::dropIfExists('project_goods_draft');
        Schema::dropIfExists('project_case');
        Schema::dropIfExists('project_case_draft');
        Schema::dropIfExists('project_course');
        Schema::dropIfExists('project_course_draft');
        Schema::dropIfExists('project_cloud');
        Schema::dropIfExists('project_cloud_draft');
        Schema::dropIfExists('project_product');
        Schema::dropIfExists('project_product_draft');
        Schema::dropIfExists('project_relate');
        Schema::dropIfExists('project_relate_draft');
        Schema::dropIfExists('goods_trial');
        Schema::dropIfExists('goods_trial_draft');
        Schema::dropIfExists('project_top');
        Schema::dropIfExists('goods_promote');
        Schema::dropIfExists('cloud');
        Schema::dropIfExists('platform');
        Schema::dropIfExists('product');
        Schema::dropIfExists('supplier');
        Schema::dropIfExists('address');
        Schema::dropIfExists('order');
        Schema::dropIfExists('order_item');
        Schema::dropIfExists('pay_log');
        Schema::dropIfExists('revenue_log');
        Schema::dropIfExists('recommend');
        Schema::dropIfExists('tag');
        Schema::dropIfExists('tag_link');
        Schema::dropIfExists('cron_rec');
        Schema::dropIfExists('xform');
        Schema::dropIfExists('xform_data');

        Schema::table('doc_publish', function (Blueprint $table) {
            $table->dropColumn('tags');
        });
        Schema::table('comment', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->renameColumn('item', 'doc_id');
            $table->dropColumn('deleted_at');
        });
        Schema::table('likes', function (Blueprint $table) {
            $table->dropColumn('type');
        });
        Schema::table('favorite', function (Blueprint $table) {
            $table->dropColumn('type');
        });
        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn('pj_like_count');
            $table->dropColumn('pj_fav_count');
            $table->dropColumn('alipay_account');
            $table->dropColumn('intro');
            $table->dropColumn('promote_revenue');
            $table->dropColumn('revenue');
        });
    }
}
