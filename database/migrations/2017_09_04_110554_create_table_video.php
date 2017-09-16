<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVideo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("videos", function ( Blueprint $table){
            $table->smallIncrements("id");
            $table->string("title")->default("Untitle");
            $table->string("url");
            $table->smallInteger("queue")->default(0);
            $table->enum('types', ['published','unpublished'])->default("unpublished");
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
        Schema::drop("videos");
    }
}
