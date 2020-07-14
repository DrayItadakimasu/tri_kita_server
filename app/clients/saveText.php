<?php

namespace App\clients;

use Illuminate\Database\Eloquent\Model;

class saveText extends Model
{
    protected $table = 'save_info_text';
    protected $fillable = [
        'user_id', 'text',
    ];
    public $timestamps = false;
}
