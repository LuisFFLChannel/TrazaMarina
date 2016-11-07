<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToEmbarcacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('embarcacion', function (Blueprint $table) {
            $table->foreign('certificado_matricula_id')->references('id')->on('certificadoMatricula');
            $table->foreign('permiso_pesca_id')->references('id')->on('permisoPesca');
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
        Schema::table('embarcacion', function (Blueprint $table) {
            $table->dropForeign('embarcacion_certificado_matricula_id_foreign');
            $table->dropForeign('embarcacion_permiso_pesca_id_foreign');
        });
    }
}
