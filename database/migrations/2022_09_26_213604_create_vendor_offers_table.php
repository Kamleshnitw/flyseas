<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_offers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('banner');
            $table->string('type');
            $table->string('category_id')->nullable(); 
            $table->string('product_id');
            $table->string('last_date');
            $table->string('for_user');
            $table->string('discount');
            $table->string('discount_type');
            $table->string('minimum_value_type');
            $table->string('minimum_value');
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('vendor_offers');
    }
}
