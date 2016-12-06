<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspecieMarinaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('especieMarina', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('nombreCientifico');
            $table->float('promedioVida');
            $table->float('tamanoMin');
            $table->float('tamanoMax');
            $table->timestamp('inicioVeda');
            $table->timestamp('finVeda');
            $table->integer('tipoPesca_id')->unsigned();
            $table->double('factorHielo');
            $table->string('imagen'); 
            $table->boolean('activo');
            $table->softDeletes();
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
        //
        Schema::drop('especieMarina');
    }
}
