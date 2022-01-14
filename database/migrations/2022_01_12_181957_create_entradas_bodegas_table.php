<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntradasBodegasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas_bodegas', function (Blueprint $table) {
            $table->engine="InnoDB"; //Permite el borrado en cascada

            $table->id();
            $table->string("tgp")->nullable();
            $table->double('peso');
            $table->double('largo');
            $table->double('ancho');
            $table->double('alto');
            $table->string("tipo");
            $table->double('peso_volumetrico')->storedAs('(alto * ancho * largo) / 129360')->nullable();
            $table->double('volumen')->storedAs('alto * ancho * largo')->nullable();
            $table->timestamps();

            $table->string("id_cdc")->nullable();
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users'); //Constraint
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entradas_bodegas');
    }
}
