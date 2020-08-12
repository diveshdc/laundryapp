<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryProduct extends Model
{
    // use SoftDeletes;
    // protected $hidden = [
    //     'id',
    //     'product_id',
    //     'category_id',433
    //     'created_at',   
    //     'updated_at',

    // ];

     

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'product_id',
        'category_id'
    ];
    
    // public function categories()
    // {
    //     return $this->belongsTo('App\Category', 'category_id', 'id');
    // }
   
    // public function products()
    // {
    //     return $this->belongsTo('App\Product', 'product_id', 'id');
    // }
}