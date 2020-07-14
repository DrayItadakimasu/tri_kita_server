<?php

namespace App\clients;

use Illuminate\Database\Eloquent\Model;

class NotificationFcm extends Model
{
    protected $fillable = [
        'user_id', 'fcm_token'
    ];
}
