<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateFollowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('follows')) {
            Schema::create('follows', function (Blueprint $table) {
                $table->increments("id")->comment("关注表");
                $table->integer("user_id")->comment("用户id");
                $table->integer("cover_user_id")->comment("被关注用户id")->nullable()->default(0);
                $table->integer("demand_id")->comment("被关注商品id")->nullable()->default(0);
                $table->tinyInteger("state")->comment("状态，默认0：正常，1废弃")->default(0);
                $table->timestamps();
                $table->index(['user_id', 'cover_user_id', 'demand_id',]);
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
        Schema::drop('follows');
    }
}
