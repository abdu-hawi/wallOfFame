<?php

namespace App\Model\ModelUser;

use App\Model\City;
use App\Model\UserCollect;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelProfile extends Model
{
    protected $table = 'model_profiles';
    protected $fillable = [
        'id',
        'full_name',
        'age',
        'email',
        'length',
        'weight',
        'nationality',
        'start_work',
        'end_work',
        'city_id',
        'rate',
    ];

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function userID(){
        return $this->belongsTo(UserCollect::class);
    }


}
