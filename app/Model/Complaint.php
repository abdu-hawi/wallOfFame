<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        "model_id",
        "company_id",
        "description",
        "status",
        "from",
    ];
}
