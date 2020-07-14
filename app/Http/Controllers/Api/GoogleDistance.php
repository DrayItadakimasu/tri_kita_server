<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoogleDistance extends Controller
{


    static function getSslPage($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }


    // return int - km
    public static function getDistance($lat1, $lon1, $lat2, $lon2)
    {
        $url = 'https://maps.googleapis.com/maps/api/distancematrix/json?origins=' . $lat1 . ',' . $lon1 . '&destinations=' . $lat2 . ',' . $lon2 . '&language=RU&key=AIzaSyDzprR8cgeqB9ZA0jHPjBplzXhp5JYt9C8';
        $json = self::getSslPage($url);
        $result = json_decode($json);
        if ($result->status == "OK" && $result->rows[0]->elements[0]->status != 'ZERO_RESULTS')
            return round($result->rows[0]->elements[0]->distance->value / 1000, 0);
        else return false;

    }
}
