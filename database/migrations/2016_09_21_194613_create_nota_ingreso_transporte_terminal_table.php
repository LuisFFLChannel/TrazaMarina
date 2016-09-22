<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotaIngresoTransporteTerminalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('notaIngreso_transporteTerminal', function (Blueprint $table) {
            $table->integer('transporte_id')->unsigned()->index('notaIngreso_transporteTerminal_transporte_id_foreign');
            $table->integer('notaIngreso_id')->unsigned()->index('notaIngreso_transporteTerminal_notaIngreso_id_foreign');
            $table->float('toneladas');
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
        Schema::drop('notaIngreso_transporteTerminal');
    }
}
