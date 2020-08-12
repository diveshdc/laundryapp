<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeValueColoumnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('time_slotes', function (Blueprint $table) {
             $table->string('collection_date')->nullable()->change();
             $table->string('collection_time_start')->nullable()->change();
             $table->string('collection_time_end')->nullable()->change();
             $table->string('delivery_date')->nullable()->change();
             $table->string('delivery_time_start')->nullable()->change();
             $table->string('delivery_time_end')->nullable()->change();
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
