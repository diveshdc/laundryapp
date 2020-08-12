<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1555355612782UsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone_number',20);
            $table->string('building_name_no')->nullable();
            $table->string('street_name')->nullable();
            $table->string('town')->nullable();
            $table->string('device_token')->nullable();
            $table->string('device_type')->nullable();
            $table->string('referral_code')->nullable();
            $table->string('post_code')->nullable();
            $table->string('password');
            $table->string('reference_from')->nullable();
            $table->string('vehicle_number')->unique()->nullable();
            $table->datetime('email_verified_at')->nullable();
            $table->integer('loyalty_point')->nullable();
            $table->string('is_request')->nullable();
            $table->boolean('active')->default(false);
            $table->boolean('blocked')->default(false);
            $table->boolean('is_status')->default(false);
            $table->string('activation_token')->nullable();
            $table->string('referrer_code')->nullable();
            $table->string('remember_token')->nullable();
            $table->boolean('receive_offer')->default(false);
            $table->string('image_upload')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
