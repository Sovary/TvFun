<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("posts", function ( Blueprint $table){
            $table->smallIncrements("id");
            $table->string("title")->default("Untitle");
            $table->text("description");
            $table->string("thumbnail");
            $table->string("highlight");//trailer url
            $table->string("tages");
            $table->enum('types', ['published', 'drafted','unpublished'])->default("unpublished");
            $table->integer("view_count")->default(0);
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
        Schema::drop("posts");
    }
}
