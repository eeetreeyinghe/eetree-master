<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEetreeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('mobile', 32)->unique();
            $table->string('nickname');
            $table->string('password');
            $table->string('avatar', 255)->default('/img/avatar.jpeg');
            $table->integer('fav_count')->default(0);
            $table->integer('like_count')->default(0);
            $table->tinyInteger('user_type')->default(0)->comment('0:普通用户; 1:管理员，目前用于Horizon验证; 2:后台创建用户');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('doc_draft', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0);
            $table->integer('doc_id')->default(0);
            $table->integer('publish_id')->default(0);
            $table->string('share_id', 32)->default('');
            $table->integer('user_category_id')->default(0);
            $table->string('title', 255);
            $table->mediumText('content');
            $table->enum('type', array('doc', 'cv'))->default('doc');
            $table->timestamp('last_edit_at')->nullable();
            $table->timestamp('shared_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(array('user_id', 'type'));
            $table->index('doc_id');
            $table->index('publish_id');
        });
        Schema::create('doc_publish', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0);
            $table->integer('doc_id')->default(0);
            $table->string('title', 255);
            $table->string('description', 255);
            $table->string('edit_history', 255)->default('');
            $table->mediumText('content');
            $table->tinyInteger('status')->default(0)->comment('1:提交审核,8:审核不通过,9:审核通过');
            $table->text('review_remarks')->comment('审核不通过的原因');
            $table->enum('type', array('doc', 'cv'))->default('doc');
            $table->timestamp('submit_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('user_id');
            $table->index('doc_id');
        });
        Schema::create('doc', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0);
            $table->string('title', 255);
            $table->string('description', 255);
            $table->mediumText('parsed_content');
            $table->mediumText('content');
            $table->timestamp('publish_at')->nullable();
            $table->integer('view_count')->default(0);
            $table->integer('fav_count')->default(0);
            $table->integer('like_count')->default(0);
            $table->enum('type', array('doc', 'cv'))->default('doc');

            $table->timestamps();
        });
        Schema::create('doc_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('doc_id')->default(0);
            $table->string('description', 255);

            $table->timestamps();
        });
        Schema::create('doc_top', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('top_id')->default(0);
            $table->integer('threshold')->default(0);
            $table->integer('view_count')->default(0);
            $table->integer('click_count')->default(0);
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->tinyInteger('is_top')->default(0);
            $table->tinyInteger('page_index')->default(0);
            $table->tinyInteger('page_category')->default(0);
            $table->timestamp('toped_at')->nullable();

            $table->timestamps();

            $table->index('top_id');
        });
        Schema::create('favorite', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0);
            $table->integer('fav_id')->default(0);

            $table->timestamps();
        });
        Schema::create('likes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0);
            $table->integer('like_id')->default(0);

            $table->timestamps();
        });
        Schema::create('doc_category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('doc_id')->default(0);
            $table->integer('category_id')->default(0);
            $table->unique(['doc_id', 'category_id']);
        });
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->integer('order')->default(0);
            $table->string('name', 50);

            $table->timestamps();
        });
        Schema::create('user_category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0);
            $table->integer('parent_id')->default(0);
            $table->integer('order')->default(0);
            $table->string('name', 50);
            $table->timestamp('last_edit_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('user_id');
        });
        Schema::create('comment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0);
            $table->integer('doc_id')->default(0);
            $table->integer('comment_id')->default(0)->comment('父评论，0为第一层');
            $table->integer('target_id')->default(0)->comment('回复对象的评论');
            $table->integer('target_user_id')->default(0)->comment('回复对象的用户');
            $table->text('content');
            $table->integer('reply_num')->default(0);
            $table->tinyInteger('active')->default(0);

            $table->timestamps();

            $table->index('doc_id');
            $table->index('comment_id');
        });
        Schema::create('file', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('path', 255);
            $table->string('type', 50);
            $table->string('mime', 50);
            $table->integer('pid')->default(0);

            $table->timestamps();
        });
        Schema::create('notice', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0);
            $table->text('content');
            $table->tinyInteger('read')->default(0);
            $table->tinyInteger('type')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
        Schema::dropIfExists('doc_draft');
        Schema::dropIfExists('doc_publish');
        Schema::dropIfExists('doc');
        Schema::dropIfExists('doc_history');
        Schema::dropIfExists('doc_top');
        Schema::dropIfExists('favorite');
        Schema::dropIfExists('likes');
        Schema::dropIfExists('doc_category');
        Schema::dropIfExists('category');
        Schema::dropIfExists('user_category');
        Schema::dropIfExists('comment');
        Schema::dropIfExists('file');
        Schema::dropIfExists('notice');
    }
}
