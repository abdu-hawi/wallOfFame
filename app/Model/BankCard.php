<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BankCard extends Model
{
    protected $fillable = [
    	"card_number", "owner_name", "exp_date", "ccv", "id", "card_type"
    ];
}
