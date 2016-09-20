<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('idUsuario');
            $table->string('nombres');
            $table->string('apellidos');
            $table->integer('dni')->unique();
            $table->string('direccion');
            $table->string('correo')->unique();
            $table->integer('telefono');
            $table->string('imagen'); 
            $table->timestamp('cumpleanos');
            $table->integer('tipoUsuario_id')->unsigned();
            $table->string('usuario')->unique();
            $table->string('contrasena', 60);
            $table->rememberToken();
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
        Schema::drop('usuarios');
    }
}
