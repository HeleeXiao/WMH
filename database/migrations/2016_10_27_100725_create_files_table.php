<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments("id");
            $table->char("token",25)->unique()->comment("唯一编号");
            $table->tinyInteger("state")->comment("状态，默认0：正常，1废弃")->default(0);
            $table->tinyInteger("status")->comment("状态")->default(0);
            $table->tinyInteger("type")->comment("类型，默认0：书籍，1：影像")->default(0);
            $table->string("name")->nullable()->comment("文件名称");
            $table->string("path");
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
        Schema::drop('files');
    }
}
