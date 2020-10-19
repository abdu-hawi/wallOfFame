<?php

namespace App\Model;

use App\Model\ModelUser\ModelProfile;
use Illuminate\Database\Eloquent\Model;

class UserCollect extends Model
{
    protected $fillable =['type'];

    public function models(){
        return $this->hasOne(ModelProfile::class,'id','id');
    }

}
