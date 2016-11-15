<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateBrowseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('browses')) {
            Schema::create('browses', function (Blueprint $table) {
                $table->increments("id")->comment("浏览记录id");
                $table->integer("user_id")->comment("用户id");
                $table->integer("demand_id")->comment("商品id");
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
        Schema::drop('browses');
    }
}
