<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::hasTable('tags')) {
            Schema::create('tags', function (Blueprint $table) {
                $table->increments("id")->comment("标签id");
                $table->string("name", 20)->comment("标签名称");
                $table->tinyInteger("state")->comment("标签状态")->default(0);
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
        Schema::drop('tags');
    }
}
