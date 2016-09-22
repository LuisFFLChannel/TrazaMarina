<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToPescaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('pesca', function (Blueprint $table) {
            $table->foreign('embarcacion_id')->references('id')->on('embarcacion');
            $table->foreign('puerto_id')->references('id')->on('puerto');
            $table->foreign('permisoZarpe_id')->references('id')->on('permisoZarpe');
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
        Schema::table('pesca', function (Blueprint $table) {
            $table->dropForeign('pesca_embarcacion_id_foreign');
            $table->dropForeign('pesca_puerto_id_foreign');
            $table->dropForeign('pesca_permisoZarpe_id_foreign');
        });
    }
}
