<?php

namespace App\clients;

use App\User;
use App\clients\NotificationFcm;
use Illuminate\Database\Eloquent\Model;

class SubscriptionLoad extends Model
{
    protected $table = 'subscriptions_load';
    protected $fillable = [
        'user_id', 'active', 'load_region', 'load_area'
    ];

    public function Apns()
    {
        return $this->hasMany('App\clients\NotificationApns', 'user_id', 'user_id');
    }

    public function Fcm()
    {
        return $this->hasMany('App\clients\NotificationFcm', 'user_id', 'user_id');
    }


    public function getAdressAttribute()
    {
        return $this->load_region . " " .
            $this->load_area;
    }

}
