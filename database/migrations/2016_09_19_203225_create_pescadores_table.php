<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePescadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('pescadores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombres');
            $table->string('apellidos');
            $table->integer('dni')->unique();
            $table->integer('telefono');
            $table->string('correo');
            $table->timestamp('cumpleanos');
            $table->integer('permiso_marinero_id')->unsigned()->unique()->nullable();
            $table->integer('permiso_patron_id')->unsigned()->unique()->nullable();
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
        Schema::drop('pescadores');
    }
}
