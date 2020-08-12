<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardDetail extends Model
{
  protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'card_id',
        'customer_id',
        'last_four',
        'brand',
        'exp_month',
        'exp_year'
    ];

}
