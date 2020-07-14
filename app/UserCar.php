<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCar extends Model
{
    protected $table = 'userCars';
    protected $fillable = [
        'car_number', 'verify', 'sts_front', 'sts_back'
    ];
}
