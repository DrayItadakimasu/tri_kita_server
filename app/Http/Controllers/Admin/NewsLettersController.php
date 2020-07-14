<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\NewsLettersRequest;
use App\clients\NewsLetters;
use App\clients\NotificationFcm;
use App\User;
use App\Events\NewNewsLetter;
use Auth;

class NewsLettersController extends Controller
{
    public function show(Request $request)
    {

        // выводим все рассылки
        $NewsLetters = NewsLetters::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.newsletters', ['NewsLetters' => $NewsLetters]);

    }

    public function create(NewsLettersRequest $request)
    {

        $recipients = User::select("id", "name", "last_name")->get();


        $newNewsLetter = new NewsLetters;
        $newNewsLetter->user_id = Auth::user()->id;
        $newNewsLetter->title = $request->input('title');
        $newNewsLetter->content = $request->input('content');
        $newNewsLetter->allusers = true;
        $newNewsLetter->params = json_encode(["url" => $request->input('url')]);

        if ($newNewsLetter->save()) {

            event(new NewNewsLetter($newNewsLetter, $recipients));

            return redirect(url()->previous())
                ->withErrors($request->errors)
                ->with('success', 'Рассылка создана');

        }


    }

}
