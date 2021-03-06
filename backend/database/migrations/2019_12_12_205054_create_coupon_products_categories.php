<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponProductsCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_products_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('products')->nullable();
            $table->string('exclude_products')->nullable();
            $table->string('exclude_categories')->nullable();
            $table->string('categories')->nullable();
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
        Schema::dropIfExists('coupon_products_categories');
    }
}
