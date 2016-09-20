<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermisoZarpePescadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('permisoZarpe_pescadores', function (Blueprint $table) {
            $table->integer('permisoZarpe_id')->unsigned()->index('permisoZarpe_pescadores_permisoZarpe_id_foreign');
            $table->integer('pescadores_id')->unsigned()->index('permisoZarpe_pescadores_pescadores_id_foreign');
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
        Schema::drop('permisoZarpe_pescadores');
    }
}
