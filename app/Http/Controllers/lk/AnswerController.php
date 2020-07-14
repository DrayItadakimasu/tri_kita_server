<?php

namespace App\Http\Controllers\lk;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\clients\application;
use App\clients\answer;
use App\clients\bl;
use app\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\NewAnswer;
use App\Events\ApproveAnswer;
use Auth;

class AnswerController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request, $id)
    {
        $action = route('show.application', $id);
        // получение данных о заявке
        $application = application::findOrFail($id);

        // Первичный массив валидаци
        $valodation_arr = ['cars' => ['required', 'integer'],];

        // Проверка торга
        if ($application->without_tender != 1) {
            array_push($valodation_arr, ['cars' => ['required', 'integer'],]);
        }

        // Валидация
        $validator = Validator::make($request->all(), $valodation_arr);

        //вывод ошибок
        if ($validator->fails()) {
            return redirect($action)
                ->withErrors($validator)
                ->withInput();
        }


        // Сохранение
        $answer = new answer;
        $answer->user_id = Auth::user()->id;
        $answer->application_id = $id;


        $answer->cars = $request->input('cars');

        if (bl::where('user_id', $application->user_id)->where('blocked_id', Auth::user()->id)->first()) {

            return redirect($action)
                ->withErrors($validator)
                ->with('success', 'Ответ отклонен: Вы в черном списке у заказчика')
                ->withInput();
        }


        if (answer::where('user_id', Auth::user()->id)->where('application_id', $id)->first()) {

            return redirect($action)
                ->withErrors($validator)
                ->with('success', 'Вы уже оставляли заявку')
                ->withInput();
        }

        if ($application->user_id == Auth::user()->id) {

            return redirect($action)
                ->withErrors($validator)
                ->with('success', 'Вы не можете оставлять заявку самому себе')
                ->withInput();
        }

        if (time() > strtotime($application->date_end)) {

            return redirect($action)
                ->withErrors($validator)
                ->with('success', 'Окончен период приема заявок')
                ->withInput();
        }


        if ($application->without_tender != 1) {
            $answer->cost = $request->input('cash');
            $answer->difference = $request->input('cash') - $application->cost;
        } else {
            $answer->cost = $application->cost;
            $answer->difference = 0;
        }

        $answer->status = 1; // Присвоен статус отвечен
        if ($answer->save()) {


            event(new NewAnswer($answer));

            return redirect($action)
                ->withErrors($validator)
                ->with('success', 'Заявка добавлена');

        }

    }

    /**
     * Display the specified resource.
     *
     * @param answer $answer
     * @return Response
     */
    public function show(answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param answer $answer
     * @return Response
     */
    public function edit(answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param answer $answer
     * @return Response
     */
    public function update(Request $request, answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param answer $answer
     * @return Response
     */
    public function destroy(application $application, $answer)
    {
        $answer = answer::findOrFail($answer);
        $answer->delete();
        return redirect()->action('lk\AnswerController@listing', ['application' => $application]);
    }

    public function approve(application $application, $answer)
    {
        $answer = answer::findOrFail($answer);
        $answer->status = 2;
        if ($answer->save()) {
            event(new ApproveAnswer($answer));
        }
        return redirect()->action('lk\AnswerController@listing', ['application' => $application]);
    }

    public function unapprove(application $application, $answer)
    {
        $answer = answer::findOrFail($answer);
        $answer->status = 1;
        $answer->save();
        return redirect()->action('lk\AnswerController@listing', ['application' => $application]);
    }

    public function listing(application $application)
    {

        $answers = answer::where('application_id', $application->id)->where('status', '1')->get();
        $approves = answer::where('application_id', $application->id)->where('status', '2')->get();


        //var_dump($application);

        return view('lk.answer.listing', compact('application', 'answers', 'approves'));

    }


}
