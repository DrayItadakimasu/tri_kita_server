<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\clients\application;
use App\registries\culture;
use Auth;

class LkController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Личный кабинет - Юг-Загрузка';

        $paginate = 50;

        $applicationFilter = array();
        // основной фильтр - получение данных
        $applicationFilter = [
            'load' => $request->get('load'),
            'user' => $request->get('user'),
            'with_answers' => $request->get('with_answers'),
            'unload' => $request->get('unload'),
            'culture' => $request->get('culture'),
            'cost_from' => ($request->get('cost_from') ? $request->get('cost_from') : 0),
            'cost_to' => ($request->get('cost_to') ? $request->get('cost_to') : 9999),
        ];

        $hasAnswers = false;
        $status = $request->get('status');

        $applications = application::

        when($request->get('load'), function ($q) use ($request) {
            return $q->where('load_full_address', 'like', '%' . $request->get('load') . '%')
                ->orWhere('load_region', 'like', '%' . $request->get('load') . '%');
        })
            ->when($request->get('unload'), function ($q) use ($request) {
                return $q->where('unload_full_address', 'like', '%' . $request->get('unload') . '%')
                    ->orWhere('unload_region', 'like', '%' . $request->get('unload') . '%');
            })
            ->when($request->get('culture'), function ($q) use ($request) {
                return $q->where('culture_id', $request->get('culture'));
            })
            ->when($request->get('cost_from'), function ($q) use ($request) {
                return $q->where('cost', '>=', $request->get('cost_from'));
            })
            ->when($request->get('cost_to'), function ($q) use ($request) {
                return $q->where('cost', '<=', $request->get('cost_to'));
            })
            ->when($request->get('user'), function ($q) use ($request) {
                return $q->where('user_id', $request->get('user'));
            })
            ->when($request->get('with_answers'), function ($q) {
                return $q->has('answers');
            })
            ->when(true, function ($q) use ($status, $request) {

                // без статуса
                if ($status == '') {

                    return $q->with(['answers' => function ($q) {
                        $q->where('user_id', '=', Auth::user()->id)->select(['status', 'user_id', 'application_id']);
                    }, 'client', 'culture']);

                }
                // 0
                if ($status == '0') {
                    return $q->with(['answers' => function ($query) {
                        $query->where('user_id', '=', Auth::user()->id)->select(['status', 'user_id', 'application_id']);
                    }, 'client', 'culture',])->doesntHave('answers');
                }
                // 0+
                if ($status > '0') {

                    return $q->with(['answers' => function ($q) {
                        $q->where('user_id', '=', Auth::user()->id)->select(['status', 'user_id', 'application_id']);
                    }, 'client', 'culture'])
                        ->whereHas('answers', function ($q) use ($status) {
                            $q->where('status', '=', $status)->where('user_id', Auth::user()->id);
                        });
                }


            })
            ->when(true, function ($q) use ($status, $request) {

                // Архив
                if ($request->get('is_archive')) {
                    return $q->where('status', 2)
                        ->orWhere('date_end', '<=', Carbon::today());
                } else {
                    return $q->where('status', 1)->where('date_end', '>=', Carbon::today());
                }

            });


        $applications = $applications->orderBy('created_at', 'desc')->paginate($paginate)->appends($applicationFilter);

        $cultures = culture::all();

        // сопоставление для фильтра
        if ($applicationFilter['culture'] and !empty($cultures[$applicationFilter['culture']]['name'])) {
            $applicationFilter['culture_name'] = $cultures[$applicationFilter['culture']]['name'];
        } else $applicationFilter['culture_name'] = false;

        if (
            $request->get('cost_to') or $request->get('cost_from') or
            $request->get('culture') or $request->get('unload') or
            $request->get('load')
        ) $hasFilter = true;
        else $hasFilter = false;

        return view('lk.main', compact('title', 'hasFilter'), [
            'applications' => $applications,
            'cultures' => $cultures,
            'applicationFilter' => $applicationFilter
        ]);

    }

}
