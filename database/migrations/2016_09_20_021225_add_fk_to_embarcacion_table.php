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
            $table->foreign('certificadoMatricula_id')->references('idCertificadoMatricula')->on('certificadoMatricula');
            $table->foreign('permisoPesca_id')->references('idPermisoPesca')->on('permisoPesca');
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
            $table->dropForeign('embarcacion_certificadoMatricula_id_foreign');
            $table->dropForeign('embarcacion_permisoPesca_id_foreign');
        });
    }
}
