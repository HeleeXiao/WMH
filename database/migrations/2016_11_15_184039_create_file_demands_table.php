<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileDemandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('file_demands')) {
            Schema::create('file_demands', function (Blueprint $table) {
                $table->increments("id")->comment("商品与图片文件关系 id");
                $table->tinyInteger("demand_id")->comment("商品id");
                $table->tinyInteger("file_id")->comment("文件id");
                $table->tinyInteger("state")->comment("状态，默认0：正常，1废弃")->default(0);
                $table->timestamps();
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
        Schema::drop('file_demands');
    }
}
