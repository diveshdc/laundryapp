<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTimeSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_time_slots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->string('start_time');
            $table->string('end_time');
            $table->string('maximum_order');
            $table->string('delivery_period');
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
        Schema::dropIfExists('admin_time_slots');
    }
}
