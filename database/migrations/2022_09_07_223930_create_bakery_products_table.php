<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBakeryProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bakery_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id');
            $table->bigInteger('sub_category_id')->nullable();
            $table->longText('variation_data');
            $table->longText('variation_options');
            $table->string('product_name');
            $table->string('thumbnail');        
            $table->string('gallery');
            $table->string('tax');
            $table->string('gst')->default(0);
            $table->string('hsn_code');
            $table->longText('description');
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
        Schema::dropIfExists('bakery_products');
    }
}
