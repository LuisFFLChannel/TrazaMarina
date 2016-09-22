<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToTransportistaFrigorificoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('transportista_frigorifico', function (Blueprint $table) {
            $table->primary(['transportista_id','frigorifico_id'], 'my_long_table_primary'); /*Largo*/
            $table->foreign('transportista_id')->references('idTransportista')->on('transportista');
            $table->foreign('frigorifico_id')->references('idFrigorifico')->on('frigorifico');

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
        Schema::table('transportista_frigorifico', function (Blueprint $table) {
            $table->dropForeign('transportista_frigorifico_transportista_id_foreign');
            $table->dropForeign('transportista_frigorifico_frigorifico_id_foreign');
        });
    }
}
