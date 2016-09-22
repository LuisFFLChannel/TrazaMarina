<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportistaFrigorificoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('transportista_frigorifico', function (Blueprint $table) {
            $table->integer('transportista_id')->unsigned()->index('transportista_frigorifico_transportista_id_foreign');
            $table->integer('frigorifico_id')->unsigned()->index('transportista_frigorifico_frigorifico_id_foreign');
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
        Schema::drop('transportista_frigorifico');
    }
}
