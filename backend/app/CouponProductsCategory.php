<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CouponProductsCategory extends Model
{
     use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    // protected $guarded = ['*'];
    protected $fillable = [
        'coupon_id',
        'products',
        'exclude_products',
        'exclude_categories',
        'product_categories',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
