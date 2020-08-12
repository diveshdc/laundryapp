<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{

      protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
      	'email',
       	'token',
        'created_at',
        'updated_at',
    ];
}
