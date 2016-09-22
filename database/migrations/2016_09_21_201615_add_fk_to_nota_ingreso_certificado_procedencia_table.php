<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToNotaIngresoCertificadoProcedenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('notaIngreso_certificadoProcedencia', function (Blueprint $table) {
            $table->primary(['certificado_id','notaIngreso_id'], 'my_long_table_primary');
            $table->foreign('certificado_id')->references('id')->on('certificadoProcedencia');
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
         Schema::table('notaIngreso_certificadoProcedencia', function (Blueprint $table) {
            $table->dropForeign('notaIngreso_certificadoProcedencia_certificado_id_foreign');
            $table->dropForeign('notaIngreso_certificadoProcedencia_notaIngreso_id_foreign');
        });
    }
}
