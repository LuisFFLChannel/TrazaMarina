<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDesembarqueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('desembarque', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('fechaLlegada');
            $table->timestamp('fechaDesembarque');
            $table->integer('embarcacion_id')->unsigned();
            $table->integer('pesca_id')->unsigned();
            $table->integer('puerto_id')->unsigned();
            $table->integer('dpa_id')->unsigned();
            $table->integer('certificado_arribo_id')->unsigned()->unique()->nullable();
            $table->boolean('huboPesca');
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
        Schema::drop('desembarque');
    }
}
