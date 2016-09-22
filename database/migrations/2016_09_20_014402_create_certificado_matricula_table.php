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
            $table->string('nombreDueno');
            $table->string('apellidosDueno');
            $table->integer('dniDueno')->unique();
            $table->string('nMatricula')->unique();
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
