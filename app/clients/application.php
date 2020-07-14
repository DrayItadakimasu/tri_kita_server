<?php

namespace App\clients;

use Illuminate\Database\Eloquent\Model;

class application extends Model
{
    protected $table = 'applications';
    protected $fillable = [
        'name', 'load_full_address', 'load_region', 'load_area', 'load_city',
        'load_settlement', 'load_street', 'load_house', 'load_house', 'load_lat',
        'load_lon', 'unload_full_address', 'unload_region', 'unload_area',
        'unload_city', 'unload_settlement', 'unload_street', 'unload_house',
        'unload_lat', 'unload_lon', 'user_id', 'distance', 'date_start', 'max_scale', 'date_end',
        'where_calc', 'max_shortage', 'culture_id', 'loading_id', 'allow_call_me', 'without_tender',
        'stand', 'cost', 'amount', 'information',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'date_start',
        'date_end',
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    public function client()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function exporter()
    {
        return $this->belongsTo('App\registries\exporter', 'exporter_id');
    }

    public function answers()
    {
        return $this->belongsTo('App\clients\answer', 'id', 'application_id');
    }

    public function answer()
    {
        return $this->hasMany('App\clients\answer', 'application_id');
    }

    public function culture()
    {
        return $this->belongsTo('App\registries\culture');
    }

    public function loadingType()
    {
        return $this->belongsTo('App\registries\LoadingType', 'loading_id');
    }

    public function getFullUnloadPlaceAttribute()
    {
        return $this->unload_place . " " .
            $this->unload_street . " " .
            $this->unload_house . " " .
            $this->unload_settlement . " " .
            $this->unload_city . " " .
            $this->unload_area . " " .
            $this->unload_region . " ";
    }

    public function getFullLoadPlaceAttribute()
    {
        return $this->load_place . " " .
            $this->load_street . " " .
            $this->load_house . " " .
            $this->load_settlement . " " .
            $this->load_city . " " .
            $this->load_area . " " .
            $this->load_region . " ";
    }


}
