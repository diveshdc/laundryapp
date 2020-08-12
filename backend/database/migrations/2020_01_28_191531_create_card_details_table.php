<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_details', function (Blueprint $table) {
             $table->bigIncrements('id');
             $table->integer('user_id');
             $table->string('card_id');
             $table->string('customer_id');
             $table->string('last_four');
             $table->string('brand');
             $table->string('exp_month');
             $table->string('exp_year');
             $table->boolean('is_default')->default(false);
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
        Schema::dropIfExists('card_details');
    }
}
