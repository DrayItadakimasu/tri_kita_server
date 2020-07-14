<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userDocument extends Model
{
    protected $table = 'userDocuments';
    protected $fillable = [
        'bik',
        'bank_name',
        'bank_account',
        'bank_account_number',
        'inn',
        'inn-image',
        'agency_name',
        'ogrn',
        'ogrn_image',
        'passport_series',
        'passport_number',
        'passport_front',
        'passport_back',
        'verify'
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

}
