<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToPermisoZarpePescadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('permisoZarpe_pescadores', function (Blueprint $table) {
            $table->primary(['permisoZarpe_id','pescadores_id']);
            $table->foreign('permisoZarpe_id')->references('idPermisoZarpe')->on('permisoZarpe');
            $table->foreign('pescadores_id')->references('idPescadores')->on('pescadores');

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
        Schema::table('permisoZarpe_pescadores', function (Blueprint $table) {
            $table->dropForeign('permisoZarpe_pescadores_permisoZarpe_id_foreign');
            $table->dropForeign('permisoZarpe_pescadores_pescadores_id_foreign');
        });
    }
}
