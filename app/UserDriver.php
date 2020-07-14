<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDriver extends Model
{
    protected $table = 'userDrivers';
    protected $fillable = [
        'name',
        'last_name',
        'middle_name',
        'phone',
        'drive_front',
        'drive_back',
        'passport_front',
        'passport_back',
        'verify'
    ];
}

