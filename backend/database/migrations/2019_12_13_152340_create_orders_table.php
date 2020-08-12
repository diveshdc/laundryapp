<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->date('collection_date');
            $table->text('collection_time',20);
            $table->date('delivery_date');
            $table->text('delivery_time',20);
            $table->string('cleaningInstructions')->nullable();
            $table->boolean('is_couponcode')->default(false);
            $table->string('couponcode')->nullable();
            $table->decimal('actual_price',5,2);
            $table->decimal('final_price',5,2);
            $table->enum('status', ['Placed', 'Collected','Inprogress','Delivered','Cancelled']);
            $table->string('building_name_no',60);
            $table->string('street_name',60);
            $table->string('post_code',60);
            $table->string('delivery_notes');
            $table->string('reason')->nullable();
            $table->integer('assign_to')->nullable();
            $table->string('lat');
            $table->string('lng');
            $table->boolean('is_skip_items')->default(false);
            $table->string('accept_reject')->nullable();
            // $table->enum('accept_reject', ['Accept', 'Reject','cancel','Faild']);
            $table->boolean('is_collection')->default(false);
            $table->boolean('is_delivery')->default(false);
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
        Schema::dropIfExists('orders');
    }

    public function users()
    {
        return $this->hasOne(User::class,'id');
    }
}
