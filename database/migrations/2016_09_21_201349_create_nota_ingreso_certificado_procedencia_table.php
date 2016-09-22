<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotaIngresoCertificadoProcedenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('notaIngreso_certificadoProcedencia', function (Blueprint $table) {
            $table->integer('certificado_id')->unsigned()->index('notaIngreso_certificadoProcedencia_certificado_id_foreign');
            $table->integer('notaIngreso_id')->unsigned()->index('notaIngreso_certificadoProcedencia_notaIngreso_id_foreign');
            $table->float('toneladas');
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
        Schema::drop('notaIngreso_certificadoProcedencia');
    }
}
