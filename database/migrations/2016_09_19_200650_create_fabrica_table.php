<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFabricaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('fabrica', function (Blueprint $table) {
            $table->increments('idFabrica');
            $table->string('nombre');
            $table->string('direccion');
            $table->float('coordenadaX');
            $table->float('coordenadaY');
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
        Schema::drop('fabrica');
    }
}
