<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePescaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('pesca', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('fechaZarpe');
            $table->float('coordenadaX');
            $table->float('coordenadaY');
            $table->integer('embarcacion_id')->unsigned()->unique();
            $table->integer('puerto_id')->unsigned()->unique();
            $table->integer('permisoZarpe_id')->unsigned()->unique();
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
        Schema::drop('pesca');
    }
}
