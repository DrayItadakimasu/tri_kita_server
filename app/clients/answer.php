<?php

namespace App\clients;

use Illuminate\Database\Eloquent\Model;

class answer extends Model
{
    protected $table = 'answers';
    protected $fillable = [
        'user_id', 'status', 'id', 'application_id',
    ];

    public function listOfApplication()
    {
        return $this->hasMany('App\clients\application', 'application_id');
    }

    public function applicationHas()
    {
        return $this->hasMany('App\clients\application', 'id', "application_id");
    }

    public function application()
    {
        return $this->belongsTo('App\clients\application', 'application_id');
    }


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }


}
