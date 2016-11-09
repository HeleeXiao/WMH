<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demands', function (Blueprint $table) {
            $table->increments('id')->comment("商品id");
            $table->integer("user_id");
            $table->string('name');
            $table->string('title','40')->comment("标题")->nullable();
            $table->text('description')->comment("描述");
            $table->char('token',25)->comment("唯一编号")->unique();
            $table->tinyInteger('file_id')->comment("封面-文件关联id");
            $table->char('file_token',25)->comment("文件图片-关联token");
            $table->tinyInteger('status')->comment("系统状态0：正常;1:推荐")->default(0);
            $table->tinyInteger('type')->comment("商品类型,0:书籍，1：影像")->default(0);
            $table->tinyInteger('state')->comment("状态")->default(0);
            $table->integer('click')->comment("浏览数")->default(0);
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
        Schema::drop('demands');
    }
}
