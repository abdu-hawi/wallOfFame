<?php

namespace App\Model\ModelUser;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class ModelInit extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $table = 'model_inits';
    protected $fillable = [
        'id',
        'phone',
        'instagram',
        'img_cover',
        'nick_name',
        'password',
        'verify_phone',
        'active',
        'contract_accept',
        'end_of_subscription',
        'fcm_token',
        'fcm_uid',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function findAndValidateForPassport($username) {
        return $this->where('phone', $username)->first();
    }


}
