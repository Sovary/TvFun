<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVideoIdToReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("reports", function (Blueprint $table){
            $table->smallInteger("video_id")->unsigned();
            $table->foreign("video_id")->references('id')->on("videos")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("reports", function (Blueprint $table){

            $table->dropForeign(['video_id']);
            
        });
    }
}
