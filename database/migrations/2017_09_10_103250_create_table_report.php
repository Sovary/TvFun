<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("reports", function ( Blueprint $table){
            $table->smallIncrements("id");
            $table->enum('rep_types', ['broken','duplicate','other'])->default("other");
            $table->text("message");
            $table->ipAddress("ip");
            $table->text("agent");
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
        Schema::drop("reports");
    }
}
