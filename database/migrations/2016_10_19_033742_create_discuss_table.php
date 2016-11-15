<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscussTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::hasTable('discuss')) {
            Schema::create('discuss', function (Blueprint $table) {
                $table->increments('id');
                $table->integer("user_id")->comment("用户id");
                $table->integer("demand_id")->comment("商品id")->nullable()->default(0);
                $table->integer("parent_id")->comment("评论id")->nullable()->default(0);
                $table->text("content")->comment("内容");
                $table->tinyInteger("status")->comment("系统状态.")->default(0);
                $table->tinyInteger("state")->comment("状态。0：正常；1删除；")->default(0);
                $table->tinyInteger("type")->comment("类型:0 游客评论，1 交易者评论")->default(0);
                $table->string('file_id', 40)->comment("文件关联id");
                $table->timestamps();
                $table->index([
                    'user_id', 'demand_id', 'parent_id',
                ]);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('discuss');
    }
}
