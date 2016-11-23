<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotaIngresoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notaIngreso', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('desembarque_id')->unsigned();
            $table->integer('especie_id')->unsigned();
            $table->float('toneladas');
            $table->float('tallaPromedio');
            $table->float('toneladasSobrantes');
            $table->float('toneladasExportacion');
            $table->float('toneladasMercado');
            $table->string('codigoTraza')->nullable();
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
        Schema::drop('notaIngreso');
    }
}
