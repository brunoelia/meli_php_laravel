<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listed', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->string('meli_id');
            $table->string('category_id');
            $table->string('buying_mode');
            $table->string('listing_type_id');
            $table->datetime('start_time');
            $table->datetime('stop_time');
            $table->datetime('end_time');
            $table->string('permalink');
            $table->string('status');
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
        Schema::drop('listed');
    }
}
