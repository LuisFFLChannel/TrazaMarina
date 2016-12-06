<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkEspecieMarinaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('especieMarina', function (Blueprint $table) {
            $table->foreign('tipoPesca_id')->references('id')->on('tipoPesca');
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
        Schema::table('especieMarina', function (Blueprint $table) {
            $table->dropForeign('especieMarina_tipoPesca_id_foreign');
        });
    }
}
