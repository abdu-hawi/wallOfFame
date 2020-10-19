<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = [
        "model_id",
        "company_id",
        "rate",
        "comment",
        "booking_id",
    ];

}
