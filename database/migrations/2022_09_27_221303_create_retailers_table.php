<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetailersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retailers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('photo')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone');
            $table->string('city_id')->nullable();
            $table->string('category_id')->nullable();
            $table->boolean('kyc_status')->default(0)->comment('0- Not Upload, 1- Pending, 2- Approved, 3- Rejected');
            $table->text('kyc_remarks')->nullable();
            $table->string('wallet_balance')->default('0');
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
        Schema::dropIfExists('retailers');
    }
}
