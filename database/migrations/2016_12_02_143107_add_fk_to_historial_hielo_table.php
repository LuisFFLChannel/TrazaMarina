<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToHistorialHieloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('historialHielo', function (Blueprint $table) {
            $table->foreign('especie_id')->references('id')->on('especieMarina');
            $table->foreign('puerto_id')->references('id')->on('puerto');
            $table->foreign('embarcacion_id')->references('id')->on('embarcacion');
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
        Schema::table('historialHielo', function (Blueprint $table) {
            $table->dropForeign('historialHielo_especie_id_foreign');
            $table->dropForeign('historialHielo_puerto_id_foreign');
            $table->dropForeign('historialHielo_embarcacion_id_foreign');
        });
    }
}
