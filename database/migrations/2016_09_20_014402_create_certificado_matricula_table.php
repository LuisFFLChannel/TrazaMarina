<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificadoMatriculaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('certificadoMatricula', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo');
            $table->string('libro');
            $table->string('folio');
            $table->string('nombreDueno');
            $table->string('apellidosDueno');
            $table->integer('dniDueno')->unique();
            $table->string('nombreEmbarcacion');
            $table->string('nMatricula')->unique();
            $table->string('pdf'); 
            $table->boolean('asignado');
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
        Schema::drop('certificadoMatricula');
    }
}
