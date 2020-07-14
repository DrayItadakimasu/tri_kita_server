<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bankInfo extends Model
{
    protected $table = 'userBankReqs';
    protected $fillable = [
        'bik',
        'bank_name',
        'bank_account',
        'bank_account_number',
    ];
}
