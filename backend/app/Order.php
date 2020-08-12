<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

	use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'expiry_date'
    ];
      protected $fillable = [
    	'user_id',
        'collection_date',
        'collection_time',
        'delivery_date',
        'delivery_time',
        'cleaningInstructions',
        'delivery_notes',
        'is_couponcode',
        'transaction_id',
        'charge_id',
        'couponcode',
        'status',
        'actual_price',
        'receiver_signature',
        'receiver_image'
        
    ];

    public function products()
{
    return $this->belongsToMany('App\Products', 'order_items');
}

    public function userInfo(){
             return $this->belongsTo(User::class, 'user_id');
    }

     public function orderHistory(){
             return $this->hasMany(OrderHistory::class, 'order_id');
    }
}
