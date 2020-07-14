<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

//use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Http\Controllers\Senders\SmsRuController;
use App\User;
use Hash;
use Str;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    //   use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/lk';

    public function showResetPasswordForm()
    {

        return view('auth.passwords.phone');

    }

    public static function changePassword($old_password, $new_password, $user_id)
    {

        $user = User::find($user_id);

        if (Hash::check($old_password, $user->password)) {
            $user->password = Hash::make($new_password);
            $user->password_update = date('Y-m-d H:i:s');
            $user->remember_token = Str::random(60);
            $user->update();
            return true;
        }

        return false;

    }

    public function updatePasswordPhone($phone)
    {

        ///Запрои информации о пользователе
        $del = [' ', '(', ')', '-'];
        $phone = str_replace($del, '', $phone);

        if ($user_info = User::where('phone', $phone)->first()) {

            // Пароль можно менять раз в 22 часа
            if (true) { // временно отключено strtotime($user_info->password_update)+79200 < time()

                // Генерируем секретный код и формируем сообщение
                //$random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
                $new_code = rand(10000, 99999);
                $message = "Код восстановления пароля: " . $new_code;

                // проверка на интервал 60 секунд
                if ($user_info->password_code_time) {
                    $max_time = strtotime($user_info->password_code_time) + 60;
                } else $max_time = time() - 1000;

                if (time() > $max_time) {

                    if (SmsRuController::SendMessage($user_info->phone, $message)) {
                        // Отправка успешна
                        // Запись кода

                        //$user_info->password = Hash::make($password);
                        //$user_info->password_update =  date('Y-m-d H:i:s');
                        $user_info->password_code = $new_code;
                        $user_info->password_code_time = date('Y-m-d H:i:s');
                        $user_info->update();

                        return response()->json([
                            'result' => 'success',
                            'message' => 'Мы отправили вам код восстановления пароля',
                            'code' => 'OK',
                        ]);

                    } else {

                        return response()->json([
                            'result' => 'fail',
                            'message' => 'Код восстановления не удалось отправить получателю ' . $user_info->phone,
                            'code' => 'NO_SEND',
                        ]);
                    }

                } else {
                    //Пользователь не найден
                    return response()->json([
                        'result' => 'fail',
                        'message' => 'Попробуйте позже, прошло мало времени с момента последнего запроса кода',
                        'code' => 'CODE_TIME',
                    ]);
                }

            } else {
                return response()->json([
                    'result' => 'fail',
                    'message' => 'Пароль можно менять не чаще чем раз в 22 часа повторите попытку после ' . date('H:i d.m.Y', strtotime($user_info->password_update) + 79200),
                    'code' => 'FREQUENT_CHANGES',
                ]);
            }

        } else {
            //Пользователь не найден
            return response()->json([
                'result' => 'fail',
                'message' => 'Пользователь с таким номером телефона не найден',
                'code' => 'USER_NOT_FOUND',
            ]);
        }

    }


    public function updatePasswordCode(Request $request)
    {

        if ($user_info = User::where('phone', $request->phone)->first()) {


            if ($user_info->password_code == $request->code) {

                if (strtotime($user_info->password_code_time) + 720 < time()) {
                    return response()->json([
                        'result' => 'fail',
                        'message' => 'Код просрочен, запросите новый, код действителен только 12 минут',
                        'code' => 'OK',
                    ]);
                }

                $rules = ['password' => ['required', 'string', 'min:8']];
                $input = ['password' => $request->password];
                if (Validator::make($input, $rules)->passes()) {


                    $user_info->password_update = date('Y-m-d H:i:s');
                    $user_info->password = Hash::make($request->password);
                    $user_info->password_code = NULL;
                    $user_info->save();

                    return response()->json([
                        'result' => 'success',
                        'message' => 'Пароль изменен, сейчас вы будете перемещены на страницу авторизации',
                        'code' => 'OK',
                    ]);

                } else {
                    return response()->json([
                        'result' => 'fail',
                        'message' => 'Такой пароль не может быть использован',
                        'code' => 'NO_CORRECT_PASSWORD',
                    ]);
                }

            } else {

                return response()->json([
                    'result' => 'fail',
                    'message' => 'Неверный код',
                    'code' => 'NO_CODE',
                ]);
            }


        } else {
            //Пользователь не найден
            return response()->json([
                'result' => 'fail',
                'message' => 'Пользователь с таким номером телефона не найден',
                'code' => 'USER_NOT_FOUND',
            ]);
        }
    }

}
