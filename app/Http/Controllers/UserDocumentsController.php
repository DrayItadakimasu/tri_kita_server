<?php


namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\userDocument;
use App\Http\Requests\docsRequest;
use Intervention\Image\ImageManager;

class UserDocumentsController extends Controller
{
    public function edit(docsRequest $request, $user_id)
    {
        //Банковские реквизиты
        if ($doc = userDocument::where('user_id', $user_id)->get()->first()) {
            $doc->verify = 1;
        } else {
            $doc = new userDocument;
        }

        $doc->user_id = $user_id;


        //Пользовательские документы
        //ИНН
        $doc->inn = $request->inn;
        //ОГРН
        $doc->agency_name = $request->agency_name;
        $doc->ogrn = $request->ogrn;
        //Паспортные данные
        $doc->passport_series = $request->passport_series;
        $doc->passport_number = $request->passport_number;


        //Паспортные данные скан
        if ($request->file('passport_front')) {
            $image = new ImageManager;

            //Уникальное имя изображения
            $md5Name = md5_file($request->file('passport_front')->getRealPath());
            $guessExtension = $request->file('passport_front')->guessExtension();

            $path = $request->file('passport_front')->storeAs('users_passports', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/users_passports/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();

            $doc->passport_front = $md5Name . '.' . $guessExtension;
        }
        if ($request->file('passport_back')) {
            //Уникальное имя изображения
            $image = new ImageManager;

            $md5Name = md5_file($request->file('passport_back')->getRealPath());
            $guessExtension = $request->file('passport_back')->guessExtension();

            $path = $request->file('passport_back')->storeAs('users_passports', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/users_passports/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();
            $doc->passport_back = $md5Name . '.' . $guessExtension;
        }

        //ИНН скан
        if ($request->file('inn_image')) {
            $image = new ImageManager;

            //Уникальное имя изображения
            $md5Name = md5_file($request->file('inn_image')->getRealPath());
            $guessExtension = $request->file('inn_image')->guessExtension();

            $path = $request->file('inn_image')->storeAs('users_inn', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/users_inn/' . $md5Name . '.' . $guessExtension);
            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();
            $doc->inn_image = $md5Name . '.' . $guessExtension;
        }
        //ОГРН скан
        if ($request->file('ogrn_image')) {
            $image = new ImageManager;

            //Уникальное имя изображения
            $md5Name = md5_file($request->file('ogrn_image')->getRealPath());
            $guessExtension = $request->file('ogrn_image')->guessExtension();

            $path2 = $request->file('ogrn_image')->storeAs('users_ogrn', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/users_ogrn/' . $md5Name . '.' . $guessExtension);
            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();

            $doc->ogrn_image = $md5Name . '.' . $guessExtension;
        }

        $doc->save();

        return redirect()->back()->withInput();
    }
}
