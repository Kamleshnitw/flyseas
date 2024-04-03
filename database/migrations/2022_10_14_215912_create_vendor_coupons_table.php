<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_coupons', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('banner');
            $table->string('coupon_name');
            $table->string('uses_type');
            $table->string('discount_type');
            $table->string('discount');
            $table->string('minimum_order_amount')->nullable();
            $table->string('start_date');
            $table->string('end_date');
            $table->string('short_description');
            $table->string('terms_conditions');
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
        Schema::dropIfExists('vendor_coupons');
    }
}
