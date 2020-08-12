<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
     use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'expiry_date'
    ];
    // protected $guarded = ['*'];
    protected $fillable = [
        'coupon_code',
        'price',
        'expiry_date',
        'discount_type',
        'minimum_spend',
        'maximum_spend',
        'usage_limit_per_coupon',
        'limit_usage_x_item',
        'usage_limit_per_user',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
