<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostoFaenaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('costoFaena', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->text('descripcion');
            $table->float('costo');
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
        Schema::drop('costoFaena');
    }
}
