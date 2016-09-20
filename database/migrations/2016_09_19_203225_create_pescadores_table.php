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
            $table->increments('idPescadores');
            $table->string('nombres');
            $table->string('apellidos');
            $table->integer('dni')->unique();
            $table->integer('telefono');
            $table->string('correo');
            $table->timestamp('cumpleanos');
            $table->boolean('permisoPesca');
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
