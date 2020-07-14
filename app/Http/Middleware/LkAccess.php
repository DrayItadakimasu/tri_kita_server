<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use DB;
use Auth;
use app\clients\application;

class LkAccess
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */

    public function handle($request, Closure $next, ...$roles)
    {

        // Проверка на авторизацию
        //if(!Auth::check()) return response('Unauthorized.', 401);


        foreach ($roles as $role) {

            // получение id группы по имени переданному в middleware
            $group_id = DB::table('user_groups')->where('name', $role)
                ->pluck('id')->first();

            if ($group_id) {

                //echo 'Авторизован: '.Auth::user()->group_id .'= Разрешен: '. $group_id.'<br>';

                // Проверка на доступ - сравнение разрешения
                if (Auth::user()->group_id == $group_id) return $next($request);

                if ($role == 'noverify') {
                    return $next($request);
                }

                // Проверка на верификацию
                if (!Auth::user()->phone_verified_at) return redirect('/lk/profile/smsverify');

            }


            // Проверки по особым префиксам
            if ($role == 'self') {
                // Если параметр user_id в запросе совпадает с авторизованным
                // далее если объект app/user
                if (is_a($request->route()->parameter('user_id'), 'App\User')) {

                    if ($request->route()->parameter('user_id')->id == Auth::user()->id) {
                        return $next($request);
                    }

                } else {
                    // если другое то проверяем как строку c id пользователем
                    if ($request->route()->parameter('user_id') == Auth::user()->id) {
                        return $next($request);
                    }
                }
            }

            if ($role == 'self_answers') {

                // Если параметр user_id appication в запросе совпадает с авторизованным
                if (Auth::user()->id == $request->route()->parameter('application')->user_id) {
                    return $next($request);
                }
            }

            if ($role == 'not_self') {
                // Если нне совпадает
                if (!$request->route()->parameter('user_id') == Auth::user()->id) {
                    return $next($request);
                }
            }

            if ($role == 'super_user') {
                // Если нне совпадает
                if (Auth::user()->super_user) {
                    return $next($request);
                }
            }


        }


        abort(403);


    }
}
