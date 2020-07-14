<?php

namespace App\forum;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'user_id', 'name', 'description',
    ];

    public function topics()
    {
        return $this->hasMany('App\forum\Topic', 'section_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
