<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalidaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salida_detalles', function (Blueprint $table) {
            $table->engine="InnoDB"; //Permite el borrado en cascada
            $table->id();
            $table->string("transportadora")->nullable();
            $table->string("unidad")->nullable();

            $table->timestamps();

            $table->unsignedBigInteger('importacion_id');         
            
            $table->foreign('importacion_id')->references('id')->on('salidas_importacions'); //Constraint
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salida_detalles');
    }
}
