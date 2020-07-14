<?php

namespace App\registries;

use Illuminate\Database\Eloquent\Model;

class culture extends Model
{
    protected $table = 'cultures';
    protected $fillable = [
        'name'
    ];
}
