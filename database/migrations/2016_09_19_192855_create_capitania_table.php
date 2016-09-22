<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCapitaniaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('capitania', function (Blueprint $table) {
            $table->increments('id');
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
         Schema::drop('capitania');
    }
}
