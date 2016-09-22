<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresarioComercializadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('empresarioComercializador', function (Blueprint $table) {
            $table->increments('idEmpresarioComercializador');
            $table->string('nombres');
            $table->string('apellidos');
            $table->integer('dni')->unique();
            $table->integer('telefono');
            $table->string('correo')->unique();
            $table->string('nombreEmpresa');
            $table->string('ruc'); 
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
        Schema::drop('empresarioComercializador');
    }
}
