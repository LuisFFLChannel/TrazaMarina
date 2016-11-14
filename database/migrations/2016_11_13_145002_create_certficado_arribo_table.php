<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertficadoArriboTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificadoArribo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('nMatricula');
            $table->double('toneladas');
            $table->timestamp('fechaArribo');
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
        Schema::drop('certificadoArribo');
    }
}
