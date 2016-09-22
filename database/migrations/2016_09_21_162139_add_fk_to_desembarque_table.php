<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToDesembarqueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('desembarque', function (Blueprint $table) {
            $table->foreign('embarcacion_id')->references('idEmbarcacion')->on('embarcacion');
            $table->foreign('pesca_id')->references('idPesca')->on('pesca');
            $table->foreign('puerto_id')->references('idPuerto')->on('puerto');
            $table->foreign('costoFaena_id')->references('idCostoFaena')->on('costoFaena');
            $table->foreign('dpa_id')->references('idDPA')->on('dpa');
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
        Schema::table('desembarque', function (Blueprint $table) {
            $table->dropForeign('desembarque_embarcacion_id_foreign');
            $table->dropForeign('desembarque_pesca_id_foreign');
            $table->dropForeign('desembarque_puerto_id_foreign');
            $table->dropForeign('desembarque_costoFaena_id_foreign');
            $table->dropForeign('desembarque_dpa_id_foreign');
        });
    }
}
