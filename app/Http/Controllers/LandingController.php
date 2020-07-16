<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\clients\application;
use App\registries\culture;
use Carbon\Carbon;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Сервис для поиска работы зерновозам - ЮГ ЗАГРУЗКА';
        $applicationFilter = array();

        // основной фильтр - получение данных (не используется в запросе)
        $applicationFilter = [
            'load' => $request->get('load'),
            'unload' => $request->get('unload'),
            'culture' => $request->get('culture'),
            'cost_from' => ($request->get('cost_from') ? $request->get('cost_from') : 0),
            'cost_to' => ($request->get('cost_to') ? $request->get('cost_to') : 9999),
        ];

        // Новая выборка

        // базовые правила
        $applicationWhere = [
            ['status', 1],
            ['date_end', '>=', Carbon::today()],
        ];

        $applications = application::
        where($applicationWhere)
            ->where(function ($q) use ($request) {
                $q->when($request->get('load'), function ($q) use ($request) {
                    $q->where('load_full_address', 'like', '%' . $request->get('load') . '%')
                        ->orWhere('load_region', 'like', '%' . $request->get('load') . '%');
                })
                    ->when($request->get('unload'), function ($q) use ($request) {
                        $q->where('unload_full_address', 'like', '%' . $request->get('unload') . '%')
                            ->orWhere('unload_region', 'like', '%' . $request->get('unload') . '%');
                    })
                    ->when($request->get('culture'), function ($q) use ($request) {
                        $q->where('culture_id', $request->get('culture'));
                    })
                    ->when($request->get('cost_from'), function ($q) use ($request) {
                        $q->where('cost', '>=', $request->get('cost_from'));
                    })
                    ->when($request->get('cost_to'), function ($q) use ($request) {
                        $q->where('cost', '<=', $request->get('cost_to'));
                    });
            });

        $filter = clone $applications;
        $dataMap = $filter->select('id', 'load_lat', 'load_lon')->get();

        $applications = $applications->orderBy('created_at', 'desc')->paginate(20)->appends($applicationFilter);


        $cultures = culture::all();

        // сопоставление для фильтра
        if ($applicationFilter['culture'] and !empty($cultures[$applicationFilter['culture']]['name'])) {
            $applicationFilter['culture_name'] = $cultures[$applicationFilter['culture']]['name'];
        } else $applicationFilter['culture_name'] = false;

        if ($request->get('cost_to') or $request->get('cost_from') or
            $request->get('culture') or $request->get('unload') or
            $request->get('load')
        ) $hasFilter = true;
        else $hasFilter = false;

        return view('main', compact('title', 'hasFilter'), [
            'applications' => $applications,
            'cultures' => $cultures,
            'dataMap' => $dataMap,
            'applicationFilter' => $applicationFilter
        ]);
    }


    public function howWork()
    {
        return view('front.how');
    }

    public function policy()
    {
        return view('front.policy');
    }

    public function actual(Request $request)
    {
        $applicationFilter = array();

        // основной фильтр - получение данных (не используется в запросе)
        $applicationFilter = [
            'load' => $request->get('load'),
            'unload' => $request->get('unload'),
            'culture' => $request->get('culture'),
            'cost_from' => ($request->get('cost_from') ? $request->get('cost_from') : 0),
            'cost_to' => ($request->get('cost_to') ? $request->get('cost_to') : 9999),
        ];

        // Новая выборка

        // базовые правила
        $applicationWhere = [
            ['status', 1],
            ['date_end', '>=', Carbon::today()],
        ];

        $applications = application::
        where($applicationWhere)
            ->where(function ($q) use ($request) {
                $q->when($request->get('load'), function ($q) use ($request) {
                    $q->where('load_full_address', 'like', '%' . $request->get('load') . '%')
                        ->orWhere('load_region', 'like', '%' . $request->get('load') . '%');
                })
                    ->when($request->get('unload'), function ($q) use ($request) {
                        $q->where('unload_full_address', 'like', '%' . $request->get('unload') . '%')
                            ->orWhere('unload_region', 'like', '%' . $request->get('unload') . '%');
                    })
                    ->when($request->get('culture'), function ($q) use ($request) {
                        $q->where('culture_id', $request->get('culture'));
                    })
                    ->when($request->get('cost_from'), function ($q) use ($request) {
                        $q->where('cost', '>=', $request->get('cost_from'));
                    })
                    ->when($request->get('cost_to'), function ($q) use ($request) {
                        $q->where('cost', '<=', $request->get('cost_to'));
                    });
            });

        $filter = clone $applications;
        $dataMap = $filter->select('id', 'load_lat', 'load_lon')->get();

        $applications = $applications->orderBy('created_at', 'desc')->paginate(20)->appends($applicationFilter)->take(4);


        $cultures = culture::all();

        // сопоставление для фильтра
        if ($applicationFilter['culture'] and !empty($cultures[$applicationFilter['culture']]['name'])) {
            $applicationFilter['culture_name'] = $cultures[$applicationFilter['culture']]['name'];
        } else $applicationFilter['culture_name'] = false;

        if ($request->get('cost_to') or $request->get('cost_from') or
            $request->get('culture') or $request->get('unload') or
            $request->get('load')
        ) $hasFilter = true;
        else $hasFilter = false;

        return view('actual_orders', compact( 'hasFilter'), [
            'applications' => $applications,
            'cultures' => $cultures,
            'dataMap' => $dataMap,
            'applicationFilter' => $applicationFilter
        ]);
    }
}
