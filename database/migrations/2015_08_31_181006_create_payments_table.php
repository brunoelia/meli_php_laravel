<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('meli_id');
            $table->integer('order_id');
            $table->integer('payer_id');
            $table->integer('collector_id');
            $table->integer('card_id')->nullable();
            $table->string('site_id');
            $table->string('reason')->nullable();
            $table->integer('payment_method_id')->nullable();
            $table->string('currency_id');
            $table->string('installments')->nullable();
            $table->string('issuer_id')->nullable();
            $table->string('atm_transfer_referecence_company_id')->nullable();
            $table->string('atm_transfer_reference_transaction_id')->nullable();
            $table->string('coupon_id')->nullable();
            $table->text('activation_url')->nullable();
            $table->string('available_actions')->nullable();
            $table->string('status');
            $table->string('status_code')->nullable();
            $table->string('status_detail')->nullable();
            $table->float('transaction_amount');
            $table->float('shipping_cost');
            $table->float('coupon_amount');
            $table->float('overpaid_amount');
            $table->float('total_payment_amount');
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
        Schema::drop('payments');
    }
}
