<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyers', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('meli_id');
            $table->string('nickname');
            $table->string('phone');
            $table->string('alternative_phone');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('billing_doc_type');
            $table->integer('billing_doc_number');
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
        Schema::drop('buyers');
    }
}
