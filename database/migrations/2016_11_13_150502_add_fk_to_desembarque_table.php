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
            $table->foreign('embarcacion_id')->references('id')->on('embarcacion');
            $table->foreign('pesca_id')->references('id')->on('pesca');
            $table->foreign('puerto_id')->references('id')->on('puerto');
            //$table->foreign('dpa_id')->references('id')->on('dpa');
            $table->foreign('certificado_arribo_id')->references('id')->on('certificadoArribo');
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
            //$table->dropForeign('desembarque_dpa_id_foreign');
            $table->dropForeign('desembarque_certificado_arribo_id_foreign');
        });
    }
}