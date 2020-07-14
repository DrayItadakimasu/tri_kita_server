<?php

namespace App\clients;

use Illuminate\Database\Eloquent\Model;

class FreeDrivers extends Model
{
    protected $fillable = [
        'user_id', 'description', 'place'
    ];


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }


}
