<?php

namespace App\Http\Controllers\Senders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SmsRuController extends Controller
{

    private static $api_key = "3AAD5A8F-9FCD-E91C-E3A2-860F838E4721"; //

    public function __construct()
    {

    }

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

//    // Return true / false
//    Static function SendMessage($phone, $message)
//    {
//        // Валидация номера
//        $login = 'mytimejob1';
//        $password= 'prizrak47';
//
//        $message = str_replace(' ','+',$message);
//        // Проверка на российский номер +70000000000
//        if(!preg_match('/^[+][7][0-9]{10,10}$/',$phone)) return false;
//        $phone = str_replace('+','',$phone);
//
//
//        if($json = self::getSslPage('https://smsc.ru/sys/send.php?login='.$login.'&psw='.$password.'&phones='.$phone.'&mes='.$message.'&fmt=3')) {
//            $result = json_decode($json);
//            if ($result) {
//
//               if(isset($result->cnt)) { if ($result->cnt=='1') return true; else return false; } else return false;
//
//            } else return false;
//
//        }
//
//
//    }


    static function SendMessage($phone, $message)
    {
        // Валидация номера

        $message = str_replace(' ', '+', $message);
        // Проверка на российский номер +70000000000
        if (!preg_match('/^[+][7][0-9]{10,10}$/', $phone)) return false;
        $phone = str_replace('+', '', $phone);


        if ($json = self::getSslPage('https://sms.ru/sms/send?api_id=' . self::$api_key . '&to=' . $phone . '&msg=' . $message . '&test=1&json=1')) {
            $result = json_decode($json);
            if ($result) {

                if ($result->status == 'OK') return true; else return false;

            } else return false;

        }
    }

}
