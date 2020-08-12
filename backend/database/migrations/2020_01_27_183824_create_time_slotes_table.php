<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeSlotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_slotes', function (Blueprint $table) {
             $table->bigIncrements('id');
             $table->date('collection_date');
             $table->time('collection_time_start');
             $table->time('collection_time_end');
             $table->date('delivery_date');
             $table->time('delivery_time_start');
             $table->time('delivery_time_end');
             $table->boolean('is_free_collection')->default(false);
             $table->boolean('is_free_delivery')->default(false);
             $table->integer('is_free_collection_limit')->default(null);
             $table->integer('is_free_delivery_limit')->default(null);
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
        Schema::dropIfExists('time_slotes');
    }
}
