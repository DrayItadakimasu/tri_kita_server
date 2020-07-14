<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Senders\SmsRuController;
use Auth;

class SmsVerificationController extends Controller
{

    public function PageVerification()
    {
        self::updateCode();
        return view('auth.smsverify');
    }


    public function verify($sms_code = false)
    {

        // Получение данных текущего пользователя

        $user_id = Auth::user()->id;
        $user_info = User::where('id', $user_id)->first();

        if (!$user_info->phone_verified_at) { // проверка верификации

            if ($user_info->phone_verified_code == $sms_code) {
                // введенный код совпал

                // Запись времени подтверждения и активация
                $user_info->phone_verified_at = date('Y-m-d H:i:s');
                $user_info->active = 1;
                $user_info->update();


                return response()->json([
                    'result' => 'success',
                    'message' => 'Номер телефона подтвержден',
                    'code' => 'OK',
                ]);


            } else {
                // введенный код не совпал

                return response()->json([
                    'result' => 'fail',
                    'message' => 'Неверный код',
                    'code' => 'NCODE',

                ]);

            }

        } else {
            // Номер уже подтвержден

            return response()->json([
                'result' => 'fail',
                'message' => 'Ранее номер уже был подтвержден',
                'update' => $user_info->phone_verified_at,
                'code' => 'VEFIFY',
            ]);


        }

    }

    public function updateCode($user_id = false)
    {

        // Получение id текущего пользователя
        // при отсутствии в параметре функции

        if (!$user_id) $user_id = Auth::user()->id;

        // запрос информации
        $user_info = User::where('id', $user_id)->first();

        // проверяем верификацию
        if ($user_info->phone_verified_at == "null") {

            return response()->json([
                'result' => 'fail',
                'message' => 'Пользователь уже верифицирован',
                'code' => 'VEFIFY',
            ]);

        }

        // формирование кода
        $new_code = rand(10000, 99999);


        // Отправка sms

        // проверка на интервал 60 секунд
        if ($user_info->phone_verified_code_time) {
            $max_time = strtotime($user_info->phone_verified_code_time) + 60;
        } else $max_time = time() - 1000;

        if (time() > $max_time) {

            // Запись кода
            $user_info->phone_verified_code = $new_code;
            $user_info->update();

            // Запись кода в базу
            $user_info->phone_verified_code_time = date('Y-m-d H:i:s');
            if ($user_info->update()) {

                // Отправка SMS
                if (SmsRuController::SendMessage($user_info->phone, $new_code)) {

                    // код отправлен

                    return response()->json([
                        'result' => 'success',
                        'message' => 'Сообщение отправлено',
                        'code' => 'OK',
                    ]);

                } else {

                    // Ошибка отправки

                    return response()->json([
                        'result' => 'false',
                        'message' => 'Ошибка при отправке, за подтверждением обратитесь к администратору',
                        'code' => 'NO_SEND',
                    ]);
                }

            } else {

                // код не записан
                return response()->json([
                    'result' => 'false',
                    'message' => 'Критичексая ошибка, за подтверждением обратитесь к администратору',
                    'code' => 'NO_UPDATE_CODE',
                ]);
            }

        } else {
            // прошло менее 60 секунд
            return response()->json([
                'result' => 'false',
                'message' => 'Попробуйте через 60 секунд',
                'code' => 'NO_INRERVAL',
            ]);
        }
    }

}


