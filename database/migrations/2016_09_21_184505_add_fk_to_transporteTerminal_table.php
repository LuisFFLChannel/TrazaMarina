<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToTransporteTerminalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('transporteTerminal', function (Blueprint $table) {
            $table->foreign('terminal_id')->references('id')->on('terminal');
            $table->foreign('frigorifico_id')->references('id')->on('frigorifico');
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
        Schema::table('transporteTerminal', function (Blueprint $table) {
            $table->dropForeign('transporteTerminal_terminal_id_foreign');
            $table->dropForeign('transporteTerminal_frigorifico_id_foreign');
        });
    }
}
