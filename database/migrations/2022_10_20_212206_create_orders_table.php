<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('city_id')->nullable();
            $table->bigInteger('address_id')->nullable();
            $table->string('order_id')->nullable();
            $table->longText('product_details')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('coupon_code')->nullable();
            $table->string('coupon_discount')->nullable();
            $table->string('grand_amount')->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_phone')->nullable();
            $table->longText('user_address')->nullable();
            $table->enum('order_status', ['Pending', 'Confirmed', 'Cancelled', 'Rejected', 'OnDelivery', 'Delivered'])->default('Pending');
            $table->string('payment_type')->nullable();
            $table->string('payment_status')->nullable();
            $table->longText('payment_details')->nullable();
            $table->longText('order_history')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
