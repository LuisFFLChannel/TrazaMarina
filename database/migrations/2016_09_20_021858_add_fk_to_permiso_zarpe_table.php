<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToPermisoZarpeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('permisoZarpe', function (Blueprint $table) {
            $table->foreign('embarcacion_id')->references('id')->on('embarcacion');
            $table->foreign('puerto_id')->references('id')->on('puerto');
            $table->foreign('capitania_id')->references('id')->on('capitania');
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
        Schema::table('permisoZarpe', function (Blueprint $table) {
            $table->dropForeign('permisoZarpe_embarcacion_id_foreign');
            $table->dropForeign('permisoZarpe_puerto_id_foreign');
            $table->dropForeign('permisoZarpe_capitania_id_foreign');
        });
    }
}
