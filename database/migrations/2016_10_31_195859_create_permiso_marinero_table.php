<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermisoMarineroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('permisoMarinero', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo');
            $table->string('nombres');
            $table->string('apellidos');
            $table->integer('dni')->unique();
            $table->string('numeroMarinero')->unique();
            $table->timestamp('fechaVigencia');
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
        Schema::drop('permisoMarinero');
    }
}
