<?php

namespace App\Model;

use App\Model\ModelUser\ModelProfile;
use Illuminate\Database\Eloquent\Model;

class City extends Model{
    protected $table = 'cities';
    protected $fillable = [
        'city_name_ar',
        'city_name_en',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function modelProfile(){
        return $this->hasMany(ModelProfile::class);
    }
}
