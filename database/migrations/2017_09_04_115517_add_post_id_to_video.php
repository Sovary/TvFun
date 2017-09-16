<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPostIdToVideo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("videos", function (Blueprint $table){
            $table->smallInteger("post_id")->unsigned();
            $table->foreign("post_id")->references('id')->on("posts")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("videos", function (Blueprint $table){
            $table->dropForeign(['post_id']);
        });
    }
}
