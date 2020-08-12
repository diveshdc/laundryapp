<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class TimeSlot extends Model
{
    // use SoftDeletes;
Protected $table = "time_slotes";
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'collection_date',
        'collection_time_slot',
        'delivery_date',
        'delivery_time_slot',
        'is_free_collection',
        'is_free_delivery',
        'is_free_collection_limit',
        'is_free_delivery_limit',
        'created_at',
        'updated_at',
        // 'deleted_at',
    ];

}
