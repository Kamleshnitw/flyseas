<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetailerKycsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retailer_kycs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('shop_name');
            $table->string('shop_front_image');
            $table->text('shop_full_address');
            $table->string('owner_name');
            $table->string('other_document');
            $table->string('other_document_file');
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
        Schema::dropIfExists('retailer_kycs');
    }
}
