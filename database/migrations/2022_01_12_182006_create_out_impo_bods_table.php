<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutImpoBodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('out_impo_bods', function (Blueprint $table) {
            $table->engine="InnoDB"; //Permite el borrado en cascada
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('out_imp_id');
            $table->unsignedBigInteger('out_bod_id');
            
            $table->foreign('out_imp_id')->references('id')->on('salidas__importacions'); //Constraint
            $table->foreign('out_bod_id')->references('id')->on('salidas__bodegas'); //Constraint
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('out_impo_bods');
    }
}
