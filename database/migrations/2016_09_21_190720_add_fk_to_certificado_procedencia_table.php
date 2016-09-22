<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToCertificadoProcedenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('certificadoProcedencia', function (Blueprint $table) {
            $table->foreign('fabrica_id')->references('id')->on('fabrica');
            $table->foreign('frigorifico_id')->references('id')->on('frigorifico');
            $table->foreign('empresarioComercializador_id')->references('id')->on('empresarioComercializador');
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
        Schema::table('certificadoProcedencia', function (Blueprint $table) {
            $table->dropForeign('certificadoProcedencia_fabrica_id_foreign');
            $table->dropForeign('certificadoProcedencia_frigorifico_id_foreign');
            $table->dropForeign('certificadoProcedencia_empresarioComercializador_id_foreign');
        });
    }
}
