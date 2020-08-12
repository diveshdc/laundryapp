<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
   protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price',
        'category_id',
        'name',
        'description',
        'image',
        'price',
        'sale_price',
    ];

    public function productInfo(){
             return $this->belongsTo(Product::class, 'product_id');
    }

    public function userInfo(){
             return $this->belongsTo(User::class, 'user_id');
    }
}
