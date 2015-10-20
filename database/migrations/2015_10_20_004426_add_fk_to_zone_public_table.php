<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToZonePublicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_zone', function (Blueprint $table) {

            $table->foreign('zone_id')
                  ->references('id')
                  ->on('zones')->onDelete('cascade');
            $table->foreign('public_id')
                  ->references('id')
                  ->on('public')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('public_zone', function (Blueprint $table) {
            $table->dropForeign('public_zone_zone_id_foreign');
            $table->dropForeign('public_zone_public_id_foreign');
        });
    }
}
