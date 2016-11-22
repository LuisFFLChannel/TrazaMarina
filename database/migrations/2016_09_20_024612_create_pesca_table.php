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
            $table->double('coordenadaX',15,8);
            $table->double('coordenadaY',15,8);
            $table->integer('embarcacion_id')->unsigned();
            $table->integer('puerto_id')->unsigned();
            $table->integer('permisoZarpe_id')->unsigned()->unique();
            $table->boolean('arribo');
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
