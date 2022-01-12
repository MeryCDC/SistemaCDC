<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntImpoBodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('int_impo_bods', function (Blueprint $table) {
            $table->engine="InnoDB"; //Permite el borrado en cascada
            
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('int_impo_id');
            $table->unsignedBigInteger('int_bod_id');
            
            $table->foreign('int_impo_id')->references('id')->on('entradas__importacions'); //Constraint
            $table->foreign('int_bod_id')->references('id')->on('entradas__bodegas'); //Constraint
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('int_impo_bods');
    }
}
