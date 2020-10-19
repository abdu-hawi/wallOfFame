<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class TrackCompany extends Model
{
    // this model just used in dashboard for know if the new company register
    protected $fillable =[
        'id','isRead','isActive',"company_name","gm_name"
    ];
}
