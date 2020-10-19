<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CancelBooking extends Model
{
    protected $fillable = [
        "booking_id",
        "model_id",
        "company_id",
        "description",
    ];
}
