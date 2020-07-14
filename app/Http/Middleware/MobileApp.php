<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;
use App\clients\NotificationFcm;
use Auth;
use Illuminate\Http\Request;

class MobileApp
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //echo  $request->cookie('key'); echo ' <br>  saved ';
        //echo  $request->cookie('saved_key'); die();

        $response = $next($request);

        if ($request->cookie('key') != 'null' && $request->cookie('key') && !$request->cookie('saved_key')) {
            // если есть временный ключ в куках
            // и нет постоянного

            if (Auth::check()) {
                // если авторизован
                // ищем ключ и записываем при его отсутствии
                // Возвращаем saved_key

                if (NotificationFcm::where('fcm_token', $request->cookie('key'))->get()->isEmpty()) {
                    $fcm = new NotificationFcm();
                    $fcm->user_id = Auth::user()->id;
                    $fcm->fcm_token = $request->cookie('key');
                    $fcm->save();

                }
                // удаляем временный
                //setcookie('key','',time() - 3600);
                return $response
                    ->withCookie(Cookie::forever('saved_key', $request->cookie('key')))
                    ->withCookie(Cookie::forget('key'));


            }

        } else {

            if ($request->get('mobile_app')) {

                if ($request->get('vendor') == 'android') {

                    $response
                        ->withCookie(cookie()->forever('mobile_app', 1))
                        ->withCookie(cookie()->forever('vendor', 'android'))
                        ->withCookie(cookie()->forever('key', $request->get('key')));
                }

                if ($request->get('vendor') == 'ios') {
                    $response
                        ->withCookie(cookie()->forever('mobile_app', 1))
                        ->withCookie(cookie()->forever('vendor', 'ios'))
                        ->withCookie(cookie()->forever('key', $request->get('key')));
                }

            }

        }


        return $response;
    }
}
