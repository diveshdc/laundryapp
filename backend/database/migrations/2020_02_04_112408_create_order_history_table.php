<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id');
            $table->integer('user_id');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->integer('category_id');
            $table->string('name');
            $table->text('description');
            $table->string('image');
            $table->decimal('price', 15, 2);
            $table->decimal('sale_price', 15, 2);
            $table->string('transaction_id');
            $table->string('charge_id');
            $table->enum('status', ['Placed', 'Collected','Inprogress','Delivered','Cancelled']);
            $table->text('stripe_meta');
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
        Schema::dropIfExists('order_history');
    }
}
