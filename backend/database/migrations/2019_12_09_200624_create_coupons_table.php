<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('coupon_code');
            $table->decimal('price',15,2)->nullable();
            $table->decimal('minimum_spend',15,2)->nullable();
            $table->decimal('maximum_spend',15,2)->nullable();
            $table->integer('usage_limit_per_coupon')->nullable();
            $table->integer('limit_usage_x_item')->nullable();
            $table->integer('usage_limit_per_user')->nullable();
            $table->integer('used_time')->nullable();
            $table->enum('individual_use_only',['1','0']);
            $table->enum('exclude_sale_item',['1','0']);
            $table->string('discount_type')->nullable();
            $table->date('expiry_date')->nullable();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('coupons');
    }
}