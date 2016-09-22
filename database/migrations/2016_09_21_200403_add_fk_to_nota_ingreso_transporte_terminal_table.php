<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToNotaIngresoTransporteTerminalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::table('notaIngreso_transporteTerminal', function (Blueprint $table) {
            $table->primary(['transporte_id','notaIngreso_id'], 'my_long_table_primary');
            $table->foreign('transporte_id')->references('id')->on('transporteTerminal');
            $table->foreign('notaIngreso_id')->references('id')->on('notaIngreso');

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
        Schema::table('notaIngreso_transporteTerminal', function (Blueprint $table) {
            $table->dropForeign('notaIngreso_transporteTerminal_transporte_id_foreign');
            $table->dropForeign('notaIngreso_transporteTerminal_notaIngreso_id_foreign');
        });
    }
}
