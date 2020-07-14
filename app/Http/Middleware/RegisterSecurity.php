<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use DB;
use Auth;

class RegisterSecurity
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

        $reg_group = $request->group_id;

        $find_group = DB::table('user_groups')->where('id', $reg_group)
            ->pluck('allow_register')->first();

        // Проверка на разрешение группы
        if (!$find_group) return response('Unauthorized.', 401);

        return $next($request);
    }

}
