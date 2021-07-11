<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetaDiariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_diarias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('total_slp', 10,2)->default(0);
            $table->decimal('slp_diario', 10,2)->default(0);
            $table->decimal('total_slp_ant', 10,2)->default(0);
       
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('player_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('player_id')->references('id')->on('axies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meta_diarias');
    }
}
