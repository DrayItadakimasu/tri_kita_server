<?php

namespace App\clients;

use Illuminate\Database\Eloquent\Model;


class review extends Model
{

    protected $fillable = [
        'user_id', 'autor_id', 'rating', 'content',
    ];

    //
    public function autor()
    {
        return $this->hasOne('App\User', 'id', 'autor_id');
    }

}
