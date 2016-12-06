<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermisoPescaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('permisoPesca', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo');
            //$table->string('nombre');
            $table->string('nombreEmbarcacion');
            $table->string('nMatricula');
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
        Schema::drop('permisoPesca');
    }
}
