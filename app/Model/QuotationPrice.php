<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class QuotationPrice extends Model
{
    protected $fillable = [
      'model_id', "model_nickname", 'company_id',
        "company_name", "title", "description", "date",
        "time", "price", "status", "explain_status",
         "country", "city", "img_cover", "booking_id", "from_user"
    ];

    protected $hidden = [
        'updated_at'
    ];
}
