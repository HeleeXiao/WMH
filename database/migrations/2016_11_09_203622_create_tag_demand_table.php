<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagDemandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_demands', function (Blueprint $table) {
            $table->increments("id")->comment("商品与标签关系 id");
            $table->tinyInteger("demand_id")->comment("商品id");
            $table->tinyInteger("tag_id")->comment("标签id");
            $table->tinyInteger("state")->comment("状态，默认0：正常，1废弃")->default(0);
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
         Schema::drop('tag_demands');
    }
}
