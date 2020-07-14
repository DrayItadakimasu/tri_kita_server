<?php

namespace App\Http\Controllers\lk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FreeDriversRequest;
use App\clients\FreeDrivers;
use Carbon\Carbon;
use Auth;

class FreeDriversController extends Controller
{
    public function show(Request $request)
    {

        $freeDrivers = FreeDrivers::where('created_at', '<', Carbon::now()->addDays(29))->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('lk.freedrivers', ['freeDrivers' => $freeDrivers]);

    }

    public function create(FreeDriversRequest $request)
    {

        $user = Auth::user();

        if ($user->can('create', FreeDrivers::Class)) {

            $FreeDriver = new FreeDrivers();
            $FreeDriver->user_id = Auth::user()->id;
            $FreeDriver->place = $request->input('place');
            $FreeDriver->description = $request->input('description');
            if ($FreeDriver->save()) {

                return redirect(url()->previous())
                    ->withErrors($request->errors)
                    ->with('success', 'Сообщение опубликовано');
            }


        } else {
            return back()
                ->with('success', 'Вы не можете публиковать данные');
        }


    }

    public function destroy(Request $request, FreeDrivers $FreeDrivers)
    {

        $user = Auth::user();

        if ($user->can('delete', $FreeDrivers)) {

            if ($FreeDrivers->delete()) {

                return back()
                    ->with('success', 'Сообщение удалено');

            } else {
                return back()
                    ->with('success', 'Ошибка удаления');
            }

        } else {

            return back()
                ->with('success', 'Вы не можете удалить эту запись');

        }

    }

}
