<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransporteTerminalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('transporteTerminal', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('fechaSalida');
            $table->integer('terminal_id')->unsigned();
            $table->integer('frigorifico_id')->unsigned();
            $table->integer('transportista_id')->unsigned();
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
        Schema::drop('transporteTerminal');
    }
}
