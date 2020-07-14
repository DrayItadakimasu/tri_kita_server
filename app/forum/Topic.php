<?php

namespace App\forum;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        'user_id', 'section_id', 'name', 'content',
    ];

    public function messages()
    {
        return $this->hasMany('App\forum\Message', 'topic_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
