<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
      'model_id', "model_nickname", 'company_id',
        "company_name", "title", "description", "date",
        "time", "price", "status", "explain_status",
         "country", "city", "img_cover", "model_uid", "company_uid", 'ref_payment'
    ];

    protected $hidden = [
        'updated_at'
    ];
}
