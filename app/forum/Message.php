<?php

namespace App\forum;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'user_id', 'topic_id', 'content',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
