<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('bakery_product_id');
            $table->bigInteger('category_id');
            $table->bigInteger('sub_category_id')->nullable();
            $table->longText('attribute_id')->nullable();
            $table->longText('variation_name');
            $table->longText('variation_value');
            $table->string('product_name');
            $table->longText('combination_name');
            $table->longText('thumbnail');        
            $table->longText('gallery');
            $table->longText('tax');
            $table->longText('hsn_code');
            $table->longText('description');
            $table->longText('purchase_price');
            $table->longText('selling_price');
            $table->longText('mrp_price');
            $table->longText('discount_price');
            $table->longText('discount_type');
            $table->longText('sku_code');
            $table->longText('quantity');
            $table->boolean('is_feature')->default(0);
            $table->boolean('is_active')->default(0);
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
        Schema::dropIfExists('vendor_products');
    }
}
