<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermisoZarpeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('permisoZarpe', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('nMatricula');
            $table->float('coordenadaX');
            $table->float('coordenadaY');
            $table->timestamp('fechaZarpe');
            $table->timestamp('fechaArribo');
            $table->integer('puerto_id')->unsigned();
            $table->integer('capitania_id')->unsigned();
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
        Schema::drop('permisoZarpe');
    }
}
