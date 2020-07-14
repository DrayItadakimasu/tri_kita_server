<?php

namespace App\clients;

use Illuminate\Database\Eloquent\Model;

class SubscriptionUnload extends Model
{
    protected $table = 'subscriptions_unload';
    protected $fillable = [
        'user_id', 'active', 'unload_region', 'unload_area', 'unload_settlement', 'unload_org',
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
        return $this->unload_region . " " .
            $this->unload_area . " " .
            $this->unload_settlement . " " .
            $this->unload_org;
    }

}
