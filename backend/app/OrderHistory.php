<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
	Protected $table = "order_history";
     protected $dates = [
        'created_at',
        'updated_at',
        'expiry_date'
    ];
      protected $fillable = [
    	'order_id',
        'user_id',
        'product_id',
        'category_id',
        'quantity',
        'name',
        'description',
        'image',
        'price',
        'sale_price',
        'status',
        
    ];

}
