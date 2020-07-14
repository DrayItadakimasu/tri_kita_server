<?php

namespace App\Http\Controllers\lk;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\clients\application;
use App\clients\saveText;
use App\registries\culture;
use App\registries\region;
use App\registries\exporter;
use App\registries\LoadingType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use app\User;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Api\GoogleDistance;
use Carbon\Carbon;
use App\Events\NewApplication;
use App\Rules\validateReinclusion;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $method = 'post';
        $action = route('create.application');

        $culture = culture::get();
        $loading_type = LoadingType::get();
        $regions = region::get();
        $exporters = exporter::get();
        $applicationFilter = [
            'load' => '',
            'user' => '',
            'with_answers' => '',
            'unload' => '',
            'culture' => '',
        ];
        $cultures = [];
        //echo var_dump(application::find(1)->client->name);
        //echo var_dump(application::find(1)->loadingType->label);

        return view('lk.application.create', compact('action', 'method', 'culture', 'loading_type', 'regions', 'exporters', 'applicationFilter', 'cultures'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $action = route('create.application');
        $rules = [

            // load
            'load_full_address' => ['required', 'string', 'min:3', 'max:255'],
            'load_region' => ['required', 'string', 'max:255'],
            'load_city' => ['nullable', 'string', 'max:255'],
            'load_area' => ['nullable', 'string', 'max:255'],
            'load_settlement' => ['nullable', 'string', 'max:255'],
            'load_street' => ['nullable', 'string', 'max:255'],
            'load_house' => ['nullable', 'string', 'max:255'],
            'load_lat' => ['required', 'numeric'],
            'load_lon' => ['required', 'numeric'],
            'load_place' => ['nullable', 'string', 'max:255'],

            //unload
            'unload_full_address' => ['required', 'string', 'min:3', 'max:255'],
            'unload_region' => ['required', 'string', 'max:255'],
            'unload_area' => ['nullable', 'string', 'max:255'],
            'unload_settlement' => ['nullable', 'string', 'max:255'],
            'unload_city' => ['nullable', 'string', 'max:255'],
            'unload_street' => ['nullable', 'string', 'max:255'],
            'unload_house' => ['nullable', 'string', 'max:255'],
            'unload_lat' => ['required', 'numeric'],
            'unload_lon' => ['required', 'numeric'],
            'unload_place' => ['nullable', 'string', 'max:255'],

            // info
            'distance' => ['nullable', 'numeric'],
            'date_start' => ['required', 'date:Y-m-d'],
            'date_end' => ['required', 'date:Y-m-d'],
            'max_scale' => ['required', 'numeric'],
            //'where_calc' => ['required', 'string', 'max:255'],
            'max_shortage' => ['required', 'numeric'],
            'culture_id' => ['required', 'integer'],
            'loading_id' => ['required', 'integer'],
            'allow_call_me' => ['boolean'],
            'without_tender' => ['boolean'],
            'stand' => ['nullable', 'string', 'max:255'],
            'cost' => ['required', 'numeric'],
            'amount' => ['required', 'numeric'],
            'information' => ['nullable', 'string', 'max:500'],
            'exporter' => ['nullable', 'string', 'max:255'],
            'stand_day' => ['nullable', 'integer', 'max:10'],
            'new_exporter' => ['nullable', 'string', 'max:255'],
            '_check' => ['required', new validateReinclusion],


        ];


        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return redirect($action)
                ->withErrors($validator)
                ->withInput();
        }


        $application = new application;
        $user_info = Auth::user();

        $application->exporter_id = $request->input('exporter');

        if ($request->input('new_exporter')) {

            $new_exporter = new exporter;
            $new_exporter->name = $request->input('new_exporter');
            $new_exporter->save();
            $application->exporter_id = $new_exporter->id;

        }


        //load
        $application->load_full_address = $request->input('load_full_address');
        $application->load_region = $request->input('load_region');
        $application->load_area = $request->input('load_area');
        $application->load_city = $request->input('load_city');
        $application->load_settlement = $request->input('load_settlement');
        $application->load_street = $request->input('load_street');
        $application->load_house = $request->input('load_house');
        $application->load_lat = $request->input('load_lat');
        $application->load_lon = $request->input('load_lon');
        $application->load_place = $request->input('load_place');

        //unload
        $application->unload_full_address = $request->input('unload_full_address');
        $application->unload_region = $request->input('unload_region');
        $application->unload_area = $request->input('unload_area');
        $application->unload_city = $request->input('unload_city');
        $application->unload_settlement = $request->input('unload_settlement');
        $application->unload_street = $request->input('unload_street');
        $application->unload_house = $request->input('unload_house');
        $application->unload_lat = $request->input('unload_lat');
        $application->unload_lon = $request->input('unload_lon');
        $application->unload_place = $request->input('unload_place');

        $application->user_id = $user_info->id;

        $application->date_start = date('Y-m-d', strtotime($request->input('date_start')));
        $application->date_end = date('Y-m-d', strtotime($request->input('date_end')));
        $application->max_scale = $request->input('max_scale');
        //$application->where_calc = $request->input('where_calc');
        $application->max_shortage = $request->input('max_shortage');
        $application->culture_id = $request->input('culture_id');
        $application->loading_id = $request->input('loading_id');
        $application->allow_call_me = $request->input('allow_call_me');
        $application->stand = $request->input('stand');
        $application->without_tender = $request->input('without_tender');
        $application->cost = $request->input('cost');
        $application->amount = $request->input('amount');
        $application->information = $request->input('information');

        $application->stand_day = $request->input('stand_day');


        // рассчет дистанции отключили
        // В замен расчет по ajax - контроллер GetDistance
        /*
        if(!$request->input('distance')){

            if($distance = GoogleDistance::getDistance($application->load_lat,  $application->load_lon, $application->unload_lat,  $application->unload_lon)) {
                $application->distance = $distance;
            } else {

                $validator->getMessageBag()->add('distance', 'Мы не смогли рассчитать расстояние автоматически, введите вручную');
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();

            }



        } else {
            $application->distance = $request->input('distance');
        }
        */
        $application->distance = $request->input('distance');

        if ($request->input('save_text') && $request->input('information')) {

            //var_dump($user_info->text_info);
            if (!$user_info->text_info) {

                $saveText = new saveText;
                $saveText->user_id = $user_info->id;
                $saveText->text = $request->input('information');
                $saveText->save();
                //var_dump($saveText);

            } else {
                $user_info->text_info->text = $request->input('information');
                $user_info->text_info->save();

            }
        }

        if ($application->save()) {
            event(new NewApplication($application));
        }

        return redirect($action)
            ->withErrors($validator)
            ->with('success', 'Заявка добавлена')
            ->with('application_url', route('show.application', $application->id));


    }

    /**
     * Display the specified resource.
     *
     * @param application $application
     * @return Response
     */
    public function show(application $application, $id)
    {
        $method = 'post';
        $action = route('show.application', $id);

        $application = application::findOrFail($id);

        //var_dump($application);

        // answer
        $method_answer = 'post';
        $action_answer = route('add.answer', $id);

        if ($application->without_tender != 1) $tender = true; else $tender = false;

        self::newView($application);
        return view('lk.application.show', compact('action', 'method', 'action_answer', 'method_answer', 'application', 'tender'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param application $application
     * @return Response
     */
    public function edit(application $application)
    {
        $method = 'post';
        $action = route('update.application', $application->id);


        $culture = culture::get();
        $loading_type = LoadingType::get();
        $regions = region::get();
        $exporters = exporter::get();

        //echo var_dump(application::find(1)->client->name);
        //echo var_dump(application::find(1)->loadingType->label);

        return view('lk.application.edit', compact('action', 'method', 'culture', 'loading_type', 'application', 'regions', 'exporters'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param application $application
     * @return Response
     */
    public function update(Request $request, application $application)
    {
        $action = route('edit.application', $application->id);
        $validator = Validator::make($request->all(), [

            // load
            'load_full_address' => ['required', 'string', 'min:3', 'max:255'],
            'load_region' => ['required', 'string', 'max:255'],
            'load_city' => ['nullable', 'string', 'max:255'],
            'load_area' => ['nullable', 'string', 'max:255'],
            'load_settlement' => ['nullable', 'string', 'max:255'],
            'load_street' => ['nullable', 'string', 'max:255'],
            'load_house' => ['nullable', 'string', 'max:255'],
            'load_lat' => ['required', 'numeric'],
            'load_lon' => ['required', 'numeric'],
            'load_place' => ['nullable', 'string', 'max:255'],

            //unload
            'unload_full_address' => ['required', 'string', 'min:3', 'max:255'],
            'unload_region' => ['required', 'string', 'max:255'],
            'unload_area' => ['nullable', 'string', 'max:255'],
            'unload_settlement' => ['nullable', 'string', 'max:255'],
            'unload_city' => ['nullable', 'string', 'max:255'],
            'unload_street' => ['nullable', 'string', 'max:255'],
            'unload_house' => ['nullable', 'string', 'max:255'],
            'unload_lat' => ['required', 'numeric'],
            'unload_lon' => ['required', 'numeric'],
            'unload_place' => ['nullable', 'string', 'max:255'],

            // info
            'distance' => ['required', 'numeric'],
            'date_start' => ['required', 'date:Y-m-d'],
            'date_end' => ['required', 'date:Y-m-d'],
            'max_scale' => ['required', 'numeric'],
            //'where_calc' => ['required', 'string', 'max:255'],
            'max_shortage' => ['required', 'numeric'],
            'culture_id' => ['required', 'integer'],
            'loading_id' => ['required', 'integer'],
            'allow_call_me' => ['boolean'],
            'without_tender' => ['boolean'],
            'stand' => ['nullable', 'string', 'max:255'],
            'cost' => ['required', 'numeric'],
            'amount' => ['required', 'numeric'],
            'information' => ['nullable', 'string', 'max:500'],
            'stand_day' => ['nullable', 'integer', 'max:10'],
            'exporter' => ['nullable', 'string', 'max:255'],
            'new_exporter' => ['nullable', 'string', 'max:255'],

        ]);


        if ($validator->fails()) {
            return redirect($action)
                ->withErrors($validator)
                ->withInput();
        }


        //load
        $application->load_full_address = $request->input('load_full_address');
        $application->load_region = $request->input('load_region');
        $application->load_area = $request->input('load_area');
        $application->load_city = $request->input('load_city');
        $application->load_settlement = $request->input('load_settlement');
        $application->load_street = $request->input('load_street');
        $application->load_house = $request->input('load_house');
        $application->load_lat = $request->input('load_lat');
        $application->load_lon = $request->input('load_lon');

        //unload
        $application->unload_full_address = $request->input('unload_full_address');
        $application->unload_region = $request->input('unload_region');
        $application->unload_area = $request->input('unload_area');
        $application->unload_city = $request->input('unload_city');
        $application->unload_settlement = $request->input('unload_settlement');
        $application->unload_street = $request->input('unload_street');
        $application->unload_house = $request->input('unload_house');
        $application->unload_lat = $request->input('unload_lat');
        $application->unload_lon = $request->input('unload_lon');

        //$application->user_id = Auth::user()->id;
        $application->distance = $request->input('distance');
        $application->date_start = date('Y-m-d', strtotime($request->input('date_start')));
        $application->date_end = date('Y-m-d', strtotime($request->input('date_end')));
        $application->max_scale = $request->input('max_scale');
        //$application->where_calc = $request->input('where_calc');
        $application->max_shortage = $request->input('max_shortage');
        $application->culture_id = $request->input('culture_id');
        $application->loading_id = $request->input('loading_id');
        $application->allow_call_me = $request->input('allow_call_me');
        $application->stand = $request->input('stand');
        $application->stand_day = $request->input('stand_day');

        if ($request->input('without_tender')) $application->without_tender = $request->input('without_tender');
        else $application->without_tender = NULL;

        $application->cost = $request->input('cost');
        $application->amount = $request->input('amount');
        $application->information = $request->input('information');
        $application->exporter_id = $request->input('exporter');

        // новый экспортер
        if ($request->input('new_exporter')) {

            $new_exporter = new exporter;
            $new_exporter->name = $request->input('new_exporter');
            $new_exporter->save();
            $application->exporter_id = $new_exporter->id;

        }


        $application->save();

        return redirect($action)
            ->withErrors($validator)
            ->with('success', 'Заявка обновлена')
            ->with('application_url', route('show.application', $application->id));
    }

    public function close(Request $request, application $application)
    {
        $application->status = 2;
        $application->save();

        return redirect(url()->previous())
            ->with('success_main', 'Заявка закрыта');

    }

    public function start(Request $request, application $application)
    {
        if ($application->date_end->timestamp <= Carbon::now()->timestamp) {
            $application->date_end = Carbon::today()->addWeeks(2);
        }
        $application->status = 1;
        $application->save();
        return redirect(url()->previous())
            ->with('success_main', 'Заявка возобновлена');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param application $application
     * @return Response
     */
    public function destroy(application $application)
    {

        $application->answers()->delete();
        $application->delete();

        return redirect(url()->previous())
            ->with('success_main', 'Заявка и все ответы на нее удалены');
    }

    public function getDistance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'load_lat' => ['required', 'numeric'],
            'load_lon' => ['required', 'numeric'],
            'unload_lat' => ['required', 'numeric'],
            'unload_lon' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return [
                'errors' => 1,
                'message' => 'Данные переданные для расчета не верны',
                'messages' => $validator->errors()];

        }

        if ($distance = GoogleDistance::getDistance($request->load_lat, $request->load_lon, $request->unload_lat, $request->unload_lon)) {
            return ['result' => 1, 'distance' => $distance];
        } else {

            return ['errors' => 1, 'message' => 'Ошибка расчета расстояния',];

        }


    }

    public function getPlaceLoad(Request $request)
    {
        //place load city area
        $search = $request->post('s');
        $type = $request->post('where');

        if ($type == 'load') {
            $result = application::select('load_area', 'load_city', 'load_settlement', 'load_full_address')
                ->where(function ($q) use ($search) {
                    return $q
                        ->where('load_area', 'like', '%' . $search . '%')
                        ->orWhere('load_city', 'like', '%' . $search . '%')
                        ->orWhere('load_settlement', 'like', '%' . $search . '%');
                    //->orWhere('load_region', 'like', '%'.$search.'%');
                })
                ->where(function ($q) {
                    return $q
                        ->Where('status', 1)
                        ->Where('date_end', '>', Carbon::today()->format('Y.m.d'));
                })
                ->distinct()
                ->orderBy('load_full_address', 'asc')
                ->limit(150)
                ->get();


            $result_regions = application::select('load_region')
                ->where('load_region', 'like', '%' . $search . '%')
                ->distinct()
                ->orderBy('load_region', 'asc')
                ->limit(150)
                ->get();

            $merged = array_merge($result->toArray(), $result_regions->toArray());
            return $merged;

        }

        if ($type == 'unload') {
            $result = application::select('unload_area', 'unload_city', 'unload_settlement', 'unload_full_address')
                ->where(function ($q) use ($search) {
                    return $q
                        ->where('unload_area', 'like', '%' . $search . '%')
                        ->orWhere('unload_city', 'like', '%' . $search . '%')
                        ->orWhere('unload_settlement', 'like', '%' . $search . '%');
                })
                ->where(function ($q) use ($search) {
                    return $q
                        ->Where('status', 1)
                        ->Where('date_end', '>', Carbon::today()->format('Y.m.d'));
                })
                ->distinct()->orderBy('unload_full_address', 'asc')
                ->limit(150)->get();


            $result_regions = application::select('unload_region')
                ->where('unload_region', 'like', '%' . $search . '%')
                ->distinct()
                ->orderBy('unload_region', 'asc')
                ->limit(150)
                ->get();


            $merged = array_merge($result->toArray(), $result_regions->toArray());
            return $merged;

        }

        if (!$type) abort(404);

    }


    public function getApplicationInfo(Request $request)
    {

        $id = $request->get('s');
        $query = application::where('id', $id)
            ->select('id', 'load_full_address', 'unload_full_address', 'distance', 'date_start', 'date_end', 'amount', 'cost', 'culture_id', 'user_id', 'allow_call_me')
            ->with(['culture' => function ($q) {
                $q->select(['id', 'name']);
            }]);
        $result = $query->first();

        if ($result->allow_call_me == 1) {
            $result->load(['client' => function ($q) {
                $q->select(['id', 'org', 'phone']);
            }]);
            //$result = $query->load();
        } else {
            $result->load(['client' => function ($q) {
                $q->select(['id', 'org']);
            }]);
            //$result = $query->load();
        }


        if ($result) return $result; else abort(404);

    }


    public function myApplications(Request $request)
    {

        $paginate = 30;
        $applicationFilter = array();
        // основной фильтр - получение данных
        $applicationFilter = [
            'status' => $request->get('status'),
            'load' => $request->get('load'),
            'unload' => $request->get('unload'),
            'culture' => $request->get('culture'),
            'cost_from' => ($request->get('cost_from') ? $request->get('cost_from') : 0),
            'cost_to' => ($request->get('cost_to') ? $request->get('cost_to') : 9999),
        ];

        $hasAnswers = false;


        $applications = application::
        where('user_id', '=', Auth::user()->id)
            ->where(function ($q) use ($request) {

                $status = $request->get('status');

                $q->when($request->get('load'), function ($q) use ($request) {
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
                    ->where(function ($q) use ($status, $request) {

                        // без статуса
                        if ($status == 'archive') {
                            return $q->where('status', 2)
                                ->orWhere('date_end', '<=', Carbon::today());
                        }
                        // 0
                        if ($status == 'active') {
                            return $q->where('status', 1)->where('date_end', '>=', Carbon::today());
                        }

                    });
            });

        $applications = $applications->orderBy('created_at', 'desc')->paginate(20);


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


        return view('lk.application.my', compact('hasFilter'), [
            'applications' => $applications,
            'cultures' => $cultures,
            'applicationFilter' => $applicationFilter
        ]);
    }

    static function newView(application $application)
    {

        $application->views = $application->views + 1;
        $application->save();


    }

    public function up(Application $application)
    {
        $application->created_at = Carbon::now();
        // отправляем пуш
        if ($application->save()) {
            event(new NewApplication($application));
            return redirect(url()->previous())
                ->with('success_main', 'Заявка поднята');
        }

    }


}
