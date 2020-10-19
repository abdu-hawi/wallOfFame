<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Setting extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'site_name_ar',
        'site_name_en',
        'logo',
        'icon',
        'email',
        'main_lang',
        'descriptions',
        'keywords',
        'status',
        'msg_maintenance_ar',
        'msg_maintenance_en',
    ];
}
