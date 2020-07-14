<?php

namespace App\Http\Controllers\lk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\clients\bl;
use app\User;
use Auth;


class BlackListController extends Controller
{

    public function allblackList(User $user_id = null)
    {

        if (empty($user_id)) {
            $user_id = Auth::user();
        }

        $black_list = $user_id->black_list->all();

        //return $black_list;
        return view('lk.profile.blacklist', ['black_list' => $black_list]);

    }

    public function create(Request $request)
    {

        if (Auth::user()->id == $request->post('user')) {

            if (self::blocking($request->post('user'), $request->post('blocked'))) {
                return redirect(url()->previous())
                    ->with('success_main', 'Пользователь заблокирован');
            } else {
                return redirect(url()->previous())
                    ->with('fail_main', 'Ошибка блокировки');
            }

        } else {
            return redirect(url()->previous())
                ->with('fail_main', 'Ошибка блокировки: нет доступа');
        }

    }

    public function delete(Request $request)
    {

        if (BlackListController::unblocking($request->post('user'), $request->post('blocked'))) {
            return redirect(url()->previous())
                ->with('success_main', 'Пользователь разблокирован');
        } else {
            return redirect(url()->previous())
                ->with('fail_main', 'Ошибка разблокировки');
        }
    }

    public function blocking($user, $blocked)
    {

        $user = user::findOrFail($user);
        $blocked = user::findOrFail($blocked);
        $block = new bl;
        $block->user_id = $user->id;
        $block->blocked_id = $blocked->id;
        if ($block->save()) return true; else return false;

    }

    public function unblocking($user, $blocked)
    {

        $user = user::findOrFail($user);
        $blocked = user::findOrFail($blocked);

        if ($block = bl::where('user_id', $user->id)->where('blocked_id', $blocked->id)->first()) {
            $block->delete();
            return true;
        } else {
            return false;
        }

    }

}
