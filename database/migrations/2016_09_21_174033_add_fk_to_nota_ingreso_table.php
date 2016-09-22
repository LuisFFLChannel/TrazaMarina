<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToNotaIngresoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
            Schema::table('notaIngreso', function (Blueprint $table) {
                $table->foreign('desembarque_id')->references('idDesembarque')->on('desembarque');
                $table->foreign('especie_id')->references('idEspecie')->on('especieMarina');
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
        Schema::table('notaIngreso', function (Blueprint $table) {
            $table->dropForeign('notaIngreso_desembarque_id_foreign');
            $table->dropForeign('notaIngreso_especie_id_foreign');

        });
    }
}
