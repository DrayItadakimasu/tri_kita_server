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

    public function edit(Request $request, $user_id){
        if ($doc = userDocument::where('user_id', $user_id)->get()->first()) {
            $doc->verify = 1;
        } else {
            $doc = new userDocument;
        }
        $doc->user_id = $user_id;
        //ЕГРИП
        if ($request->file('egrip')) {
            $image = new ImageManager;

            //Уникальное имя изображения
            $md5Name = md5_file($request->file('egrip')->getRealPath());
            $guessExtension = $request->file('egrip')->guessExtension();

            $path = $request->file('egrip')->storeAs('users_egrip', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/users_egrip/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();

            $doc->egrip = $md5Name . '.' . $guessExtension;
        }

        //ИНН
        if ($request->file('inn')) {
            $image = new ImageManager;

            //Уникальное имя изображения
            $md5Name = md5_file($request->file('inn')->getRealPath());
            $guessExtension = $request->file('inn')->guessExtension();

            $path = $request->file('inn')->storeAs('users_inn', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/users_inn/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();

            $doc->inn = $md5Name . '.' . $guessExtension;
        }
        //ЕГРИП выписка
        if ($request->file('inn')) {
            $image = new ImageManager;

            //Уникальное имя изображения
            $md5Name = md5_file($request->file('inn')->getRealPath());
            $guessExtension = $request->file('inn')->guessExtension();

            $path = $request->file('inn')->storeAs('users_inn', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/users_inn/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();

            $doc->inn = $md5Name . '.' . $guessExtension;
        }
        //Паспортные данные ИП
        if ($request->file('ip_pass_1')) {
            $image = new ImageManager;

            //Уникальное имя изображения
            $md5Name = md5_file($request->file('ip_pass_1')->getRealPath());
            $guessExtension = $request->file('ip_pass_1')->guessExtension();

            $path = $request->file('ip_pass_1')->storeAs('ip_passports', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/ip_passports/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();

            $doc->ip_pass_1 = $md5Name . '.' . $guessExtension;
        }
        if ($request->file('ip_pass_2')) {
            $image = new ImageManager;

            //Уникальное имя изображения
            $md5Name = md5_file($request->file('ip_pass_2')->getRealPath());
            $guessExtension = $request->file('ip_pass_2')->guessExtension();

            $path = $request->file('ip_pass_2')->storeAs('ip_passports', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/ip_passports/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();

            $doc->ip_pass_2 = $md5Name . '.' . $guessExtension;
        }
        if ($request->file('ip_pass_3')) {
            $image = new ImageManager;

            //Уникальное имя изображения
            $md5Name = md5_file($request->file('ip_pass_3')->getRealPath());
            $guessExtension = $request->file('ip_pass_3')->guessExtension();

            $path = $request->file('ip_pass_3')->storeAs('ip_passports', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/ip_passports/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();

            $doc->ip_pass_3 = $md5Name . '.' . $guessExtension;
        }
        //Карточка контрагента
        if ($request->file('contragent_card')) {
            $image = new ImageManager;

            //Уникальное имя изображения
            $md5Name = md5_file($request->file('contragent_card')->getRealPath());
            $guessExtension = $request->file('contragent_card')->guessExtension();

            $path = $request->file('contragent_card')->storeAs('contragent_cards', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/contragent_cards/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();

            $doc->contragent_card = $md5Name . '.' . $guessExtension;
        }
        //Права на владение
        if ($request->file('ownership_1')) {
            $image = new ImageManager;

            //Уникальное имя изображения
            $md5Name = md5_file($request->file('ownership_1')->getRealPath());
            $guessExtension = $request->file('ownership_1')->guessExtension();

            $path = $request->file('ownership_1')->storeAs('ownership_docs', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/ownership_docs/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();

            $doc->ownership_1 = $md5Name . '.' . $guessExtension;
        }
        if ($request->file('ownership_2')) {
            $image = new ImageManager;

            //Уникальное имя изображения
            $md5Name = md5_file($request->file('ownership_2')->getRealPath());
            $guessExtension = $request->file('ownership_2')->guessExtension();

            $path = $request->file('ownership_2')->storeAs('ownership_docs', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/ownership_docs/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();

            $doc->ownership_2 = $md5Name . '.' . $guessExtension;
        }
        if ($request->file('ownership_3')) {
            $image = new ImageManager;

            //Уникальное имя изображения
            $md5Name = md5_file($request->file('ownership_3')->getRealPath());
            $guessExtension = $request->file('ownership_3')->guessExtension();

            $path = $request->file('ownership_3')->storeAs('ownership_docs', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/ownership_docs/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();

            $doc->ownership_3 = $md5Name . '.' . $guessExtension;
        }
        //Водительское удостоверение
        if ($request->file('driverpass')) {
            $image = new ImageManager;

            //Уникальное имя изображения
            $md5Name = md5_file($request->file('driverpass')->getRealPath());
            $guessExtension = $request->file('driverpass')->guessExtension();

            $path = $request->file('driverpass')->storeAs('drivers_docs', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/drivers_docs/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();

            $doc->driverpass = $md5Name . '.' . $guessExtension;
        }
        //Паспорт удостоверяющий личность водителя
        if ($request->file('driver_pass_1')) {
            $image = new ImageManager;

            //Уникальное имя изображения
            $md5Name = md5_file($request->file('driver_pass_1')->getRealPath());
            $guessExtension = $request->file('driver_pass_1')->guessExtension();

            $path = $request->file('driver_pass_1')->storeAs('drivers_docs', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/drivers_docs/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();

            $doc->driver_pass_1 = $md5Name . '.' . $guessExtension;
        }
        if ($request->file('driver_pass_2')) {
            $image = new ImageManager;

            //Уникальное имя изображения
            $md5Name = md5_file($request->file('driver_pass_2')->getRealPath());
            $guessExtension = $request->file('driver_pass_2')->guessExtension();

            $path = $request->file('driver_pass_2')->storeAs('drivers_docs', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/drivers_docs/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();

            $doc->driver_pass_2 = $md5Name . '.' . $guessExtension;
        }
        if ($request->file('driver_pass_3')) {
            $image = new ImageManager;

            //Уникальное имя изображения
            $md5Name = md5_file($request->file('driver_pass_3')->getRealPath());
            $guessExtension = $request->file('driver_pass_3')->guessExtension();

            $path = $request->file('driver_pass_3')->storeAs('drivers_docs', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/drivers_docs/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();

            $doc->driver_pass_3 = $md5Name . '.' . $guessExtension;
        }
        //9.Список автотранспорта
        if ($request->file('cars_list')) {
            $image = new ImageManager;

            //Уникальное имя изображения
            $md5Name = md5_file($request->file('cars_list')->getRealPath());
            $guessExtension = $request->file('cars_list')->guessExtension();

            $path = $request->file('cars_list')->storeAs('drivers_docs', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/drivers_docs/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();

            $doc->cars_list = $md5Name . '.' . $guessExtension;
        }
        //10.Согласие на обработку персональных данных
        if ($request->file('pers_data')) {
            $image = new ImageManager;

            //Уникальное имя изображения
            $md5Name = md5_file($request->file('pers_data')->getRealPath());
            $guessExtension = $request->file('pers_data')->guessExtension();

            $path = $request->file('pers_data')->storeAs('pers_data_docs', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/pers_data_docs/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();

            $doc->pers_data = $md5Name . '.' . $guessExtension;
        }

        //11.Сведения о застрахованных лицах
        if ($request->file('insured_persons')) {
            $image = new ImageManager;

            //Уникальное имя изображения
            $md5Name = md5_file($request->file('insured_persons')->getRealPath());
            $guessExtension = $request->file('insured_persons')->guessExtension();

            $path = $request->file('insured_persons')->storeAs('pers_data_docs', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/pers_data_docs/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();

            $doc->insured_persons = $md5Name . '.' . $guessExtension;
        }
        //12.Штатное расписание (на водителей)
        if ($request->file('staff_list')) {
            $image = new ImageManager;

            //Уникальное имя изображения
            $md5Name = md5_file($request->file('staff_list')->getRealPath());
            $guessExtension = $request->file('staff_list')->guessExtension();

            $path = $request->file('staff_list')->storeAs('drivers_docs', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/drivers_docs/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();

            $doc->staff_list = $md5Name . '.' . $guessExtension;
        }
        //13.Трудовые договоры с водителями
        if ($request->file('employment_contract')) {
            $image = new ImageManager;

            //Уникальное имя изображения
            $md5Name = md5_file($request->file('employment_contract')->getRealPath());
            $guessExtension = $request->file('employment_contract')->guessExtension();

            $path = $request->file('employment_contract')->storeAs('drivers_docs', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/drivers_docs/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();

            $doc->employment_contract = $md5Name . '.' . $guessExtension;
        }

        //14.Расчет сумм налога на доходы физ.лиц
        if ($request->file('tax_amounts')) {
            $image = new ImageManager;

            //Уникальное имя изображения
            $md5Name = md5_file($request->file('tax_amounts')->getRealPath());
            $guessExtension = $request->file('tax_amounts')->guessExtension();

            $path = $request->file('tax_amounts')->storeAs('pers_data_docs', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/pers_data_docs/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();

            $doc->tax_amounts = $md5Name . '.' . $guessExtension;
        }
        //15.Гарантийное письмо
        if ($request->file('guarantee_letter')) {
            $image = new ImageManager;

            //Уникальное имя изображения
            $md5Name = md5_file($request->file('guarantee_letter')->getRealPath());
            $guessExtension = $request->file('guarantee_letter')->guessExtension();

            $path = $request->file('guarantee_letter')->storeAs('pers_data_docs', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/pers_data_docs/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();

            $doc->guarantee_letter = $md5Name . '.' . $guessExtension;
        }



        $doc->save();

        return redirect()->back();
    }
}
