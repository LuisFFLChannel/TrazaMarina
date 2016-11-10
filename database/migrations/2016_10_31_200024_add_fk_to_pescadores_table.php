<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToPescadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('pescadores', function (Blueprint $table) {
            $table->foreign('permiso_marinero_id')->references('id')->on('permisoMarinero');
            $table->foreign('permiso_patron_id')->references('id')->on('permisoPatron');
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
        Schema::table('pescadores', function (Blueprint $table) {
            $table->dropForeign('pescadores_permiso_marinero_id_foreign');
            $table->dropForeign('pescadores_permiso_patron_id_foreign');
        });
    }
}
