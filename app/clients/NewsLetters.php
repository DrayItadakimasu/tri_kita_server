<?php

namespace App\clients;

use Illuminate\Database\Eloquent\Model;

class NewsLetters extends Model
{
    protected $table = 'newsletters';
    protected $fillable = [
        'user_id', 'type', 'users', 'title', 'content', 'params', 'status', 'success',
        'fails'
    ];
    protected $casts = [
        'params' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }


}
