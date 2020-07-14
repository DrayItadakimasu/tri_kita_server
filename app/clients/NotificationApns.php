<?php

namespace App\clients;

use Illuminate\Database\Eloquent\Model;

class NotificationApns extends Model
{
    protected $fillable = [
        'user_id', 'apns_token'
    ];
}
