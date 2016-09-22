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
            $table->increments('idDesembarque');
            $table->timestamp('fechaLlegada');
            $table->integer('embarcacion_id')->unsigned();
            $table->integer('pesca_id')->unsigned();
            $table->integer('puerto_id')->unsigned();
            $table->integer('costoFaena_id')->unsigned();
            $table->integer('dpa_id')->unsigned();
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
