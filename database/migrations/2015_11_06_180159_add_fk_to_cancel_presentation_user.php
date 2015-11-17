<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToCancelPresentationUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('cancel_presentation', function (Blueprint $table) {
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cancel_presentation', function (Blueprint $table) {
            $table->dropForeign('cancel_presentation_user_id_foreign');
        });
    }
}