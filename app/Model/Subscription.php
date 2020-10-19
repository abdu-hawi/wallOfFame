<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable =[
        'duration_ar',
        'duration_en',
        'price',
        'months_count',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
