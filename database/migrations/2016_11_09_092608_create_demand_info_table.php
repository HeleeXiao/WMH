<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demand_info', function (Blueprint $table) {
            $table->increments("id")->comment("商品信息表");
            $table->integer("user_id")->comment("用户id");
            $table->integer("demand_id")->comment("商品id");
            $table->tinyInteger("state")->comment("状态，默认0：正常，1废弃")->default(0);
            $table->timestamps();
            $table->index(['demand_id',]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('demand_info');
    }
}
