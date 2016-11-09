<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_contents', function (Blueprint $table) {
            $table->increments('id')->comment("用户详细信息id");
            $table->integer('user_id')->comment("用户id")->unique();
            $table->tinyInteger('file_id')->comment("头像-文件关联id");
            $table->tinyInteger("sex")->comment("性别")->default(0);
            $table->tinyInteger("age")->comment("年龄")->nullable();
            $table->tinyInteger("country")->comment("国家")->nullable();
            $table->tinyInteger("province")->comment("省")->nullable();
            $table->tinyInteger("city")->comment("市")->nullable();
            $table->tinyInteger("education")->comment("学历")->nullable();
            $table->string("major")->comment("专业")->nullable();
            $table->string("address",120)->comment("详细地址")->nullable();
            $table->tinyInteger("state")->comment("状态，默认0：正常；1废除，2优先使用")->default(0);
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
        Schema::drop('user_contents');
    }
}
