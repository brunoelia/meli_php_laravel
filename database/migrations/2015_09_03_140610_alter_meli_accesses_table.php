<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMeliAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meli_accesses', function(Blueprint $table) {
            $table->dropColumn(['app_id', 'app_secret']);
            $table->integer('cust_id');
            $table->timestamp('expires_in');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meli_accesses', function(Blueprint $table) {
            $table->string('app_id');
            $table->string('app_secret');
            $table->dropColumn(['app_id', 'app_secret']);
        });
    }
}
