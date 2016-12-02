<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistorialHieloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('historialHielo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('especie_id')->unsigned()->index('historialHielo_especie_id_foreign');
            $table->integer('puerto_id')->unsigned()->index('historialHielo_puerto_id_foreign');
            $table->integer('embarcacion_id')->unsigned()->index('historialHielo_embarcacion_id_foreign');
            $table->timestamp('fechaMes');
            $table->integer('mes');
            $table->integer('anho');
            $table->double('toneladasPromedio');
            $table->double('hieloPromedio');
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
        Schema::drop('historialHielo');
    }
}
