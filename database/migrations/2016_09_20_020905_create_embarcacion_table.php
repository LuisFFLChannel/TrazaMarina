<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmbarcacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('embarcacion', function (Blueprint $table) {
            $table->increments('idEmbarcacion');
            $table->string('nombre');
            $table->string('nMatricula');
            $table->string('nombreDueno');
            $table->string('apellidoDueno');
            $table->float('capacidad');
            $table->float('estara');
            $table->float('manga');
            $table->float('puntual');
            $table->integer('certificadoMatricula_id')->unsigned()->unique();
            $table->integer('permisoPesca_id')->unsigned()->unique();
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
        Schema::drop('embarcacion');
    }
}
