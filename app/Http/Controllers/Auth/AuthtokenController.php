<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\clients\authtoken;

class AuthtokenController extends Controller
{
    public static function generateRandomString($length = 255)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function createToken(User $user)
    {
        $token = new authtoken;
        $token->token = self::generateRandomString();
        $token->user_id = $user->id;
        if ($token->save()) return $token; else return false;
    }

    public function exitToken(Request $request)
    {
        $user = Auth::user();
        if (!$token = self::createToken($user)) {
            return redirect()->back()->with('error', 'Не удалось сгенерировать токен авторизации');
        }

        if ($ref = $request->headers->get('referer')) $ref = '&ref=' . $ref;
        else $ref = '';

        // выход
        //if(Auth::check()) Auth::logout();
        return 'Ожидайте
            <script>
                setTimeout(function(){document.location.href = "/login/to/?user=' . $user->id . '&token=' . $token->token . $ref . '";},500);
                setTimeout(function(){ window.history.back() }, 1000);
            </script>';
        //return redirect('login/to/?user='.$user->id.'&token='.$token->token);

    }

    public function enterToken(Request $request)
    {
        $token = $request->get('token');
        $user = $request->get('user');

        if (!($token && $user)) {
            abort(404);
        }
        $user = User::findOrFail($user);

        if ($token = authtoken::where("token", $token)
            ->where("user_id", $user->id)->get()->first()) {

            //Удаление токена
            if (!$token->delete()) abort(500);

            // выход
            Auth::logout();

            // Авторизация

            Auth::login($user);

            if ($request->get('ref') != '') return redirect($request->get('ref'));
            else return redirect()->route('login');

            //return redirect()->route('edit.profile.form', ['user_id'=> $user->id]);


        } else {
            abort(403);
        }

        return redirect()->route('login');

    }


}
