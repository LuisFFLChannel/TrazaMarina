<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportistaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('transportista', function (Blueprint $table) {
            $table->increments('idTransportista');
            $table->string('nombres');
            $table->string('apellidos');
            $table->integer('dni');
            $table->integer('telefono');
            $table->string('correo');
            $table->string('brevete');
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
        Schema::drop('transportista');
    }
}
