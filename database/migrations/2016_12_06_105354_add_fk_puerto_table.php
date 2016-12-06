<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkPuertoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('puerto', function (Blueprint $table) {
            $table->foreign('categoria_id')->references('id')->on('categoriaPuerto');
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
        Schema::table('puerto', function (Blueprint $table) {
            $table->dropForeign('puerto_categoria_id_foreign');
            $table->dropForeign('puerto_capitania_id_foreign');
        });
    }
}
