<?php

namespace App\registries;

use Illuminate\Database\Eloquent\Model;

class LoadingType extends Model
{
    protected $table = 'loading_types';
    protected $fillable = [
        'name', 'label'
    ];
}
