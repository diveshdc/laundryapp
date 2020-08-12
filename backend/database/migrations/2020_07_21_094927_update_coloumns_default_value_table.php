<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColoumnsDefaultValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('time_slotes', function (Blueprint $table) {
             $table->date('collection_date')->nullable()->change();
             $table->time('collection_time_start')->nullable()->change();
             $table->time('collection_time_end')->nullable()->change();
             $table->date('delivery_date')->nullable()->change();
             $table->time('delivery_time_start')->nullable()->change();
             $table->time('delivery_time_end')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
