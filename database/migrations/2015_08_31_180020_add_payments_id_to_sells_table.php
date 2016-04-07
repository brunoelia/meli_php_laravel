<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentsIdToSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sells', function(Blueprint $table) {
            $table->integer('payment_id')->after('status_id');
            $table->integer('buyer_id')->after('payment_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sells', function(Blueprint $table) {
            $table->dropColumn('payment_id');
            $table->dropColumn('buyer_id');
        });
    }
}
