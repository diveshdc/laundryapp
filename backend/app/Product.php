<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Category;
class Product extends Model
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
        'price',
        'sale_price',
        'description',
        'category_id',
        'image'
    ];
    public function product_category()
    {
        return $this->belongsToMany(Category::class, 'category_products');
    }

}
