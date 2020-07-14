<?php

namespace App\Http\Controllers\lk;

use App\clients\review;
use App\clients\answer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Auth;


class ReviewController extends Controller
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
    public function store(Request $request)
    {

        $action = route('profile', $request->route()->parameter('user_id'));
        $user = $request->route()->parameter('user_id');


        // Первичный массив валидаци
        $validation_arr = [
            'content' => ['required', 'string'],
            'rating' => ['required', 'integer'],
        ];

        // Валидация
        $validator = Validator::make($request->all(), $validation_arr);

        //вывод ошибок
        if ($validator->fails()) {
            return redirect($action)
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::user()->id == $user) {

            return redirect($action)
                ->withErrors($validator)
                ->with('success', 'Вы не можете оставлять отзыв себе')
                ->withInput();
        }


        $review = new review;
        $review->autor_id = Auth::user()->id;
        $review->user_id = $user;
        $review->content = $request->input('content');
        $review->rating = $request->input('rating');
        $review->save();

        return redirect($action)
            ->withErrors($validator)
            ->with('success', 'Отзыв опубликован');


    }

    /**
     * Display the specified resource.
     *
     * @param review $review
     * @return Response
     */
    public function show(review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param review $review
     * @return Response
     */
    public function edit(review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param review $review
     * @return Response
     */
    public function update(Request $request, review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param review $review
     * @return Response
     */
    public function destroy(Request $request, $user_id, $review)
    {
        $action = route('profile', $request->route()->parameter('user_id'));

        echo $review;
        $review = review::find($review);
        $review->delete();

        return redirect($action);

    }
}
