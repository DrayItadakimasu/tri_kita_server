<?php

namespace App\clients;

use Illuminate\Database\Eloquent\Model;


class bl extends Model
{
    protected $table = 'black_list';
    protected $fillable = ['user_id', 'blocked_id', 'created_at', 'id'];


    public function blocked()
    {
        return $this->belongsTo('App\User', 'blocked_id');
    }


}
