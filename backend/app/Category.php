<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Hash;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use SoftDeletes;
    protected $hidden = ['pivot'];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'image',
        'description'
    ];
    public function category_product()
    {
       // return $this->hasMany('App\CategoryProduct', 'category_id', 'id');
         return $this->belongsToMany(Product::class, 'category_products');
    }
}
