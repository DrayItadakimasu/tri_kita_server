<?php

namespace App\clients;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'user_id', 'all', 'fixed', 'profile_info', 'user_docs', 'last_application', 'content', 'register'
    ];

}
