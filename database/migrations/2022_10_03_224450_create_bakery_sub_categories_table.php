<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBakerySubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bakery_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('categorie_id');
            $table->string('name');
            $table->bigInteger('thumbnail_image');
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
        Schema::dropIfExists('bakery_sub_categories');
    }
}
