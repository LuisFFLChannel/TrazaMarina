<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificadoProcedenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('certificadoProcedencia', function (Blueprint $table) {
            $table->increments('idCertificadoProcedencia');
            $table->timestamp('fechaDictada');
            $table->integer('fabrica_id')->unsigned();
            $table->integer('frigorifico_id')->unsigned();
            $table->integer('empresarioComercializador_id')->unsigned();
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
        Schema::drop('certificadoProcedencia');
    }
}
