<?php

namespace App\Http\Controllers\lk;

use Hash;
use App\User;
use App\clients\review;
use App\clients\application;
use App\clients\answer;

use App\clients\SubscriptionLoad;
use App\clients\SubscriptionUnload;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;

//use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SmsVerificationController;
use Illuminate\Support\Facades\Validator;
use Auth;
use Str;
use Storage;

//NEW
use App\userDocument;

use App\UserCar;
use App\Http\Requests\carRequest;

use App\UserDriver;
use App\Http\Requests\driverRequest;

use App\bankInfo;
use App\Http\Requests\bankInfoRequest;

use Intervention\Image\ImageManager;

class UserProfileController extends Controller
{

    public function toProfile()
    {
        return redirect()->route('profile', ['user_id' => Auth::user()->id]);
    }

    public function showProfile($user_id)
    {

        $group = User::GetGroup($user_id);
        $profile = User::findorFail($user_id);
        $reviews = review::where('user_id', $user_id);
        $reviews->with(['autor' => function ($q) {
            $q->select('id', 'name', 'last_name');
        }]);
        $reviews = $reviews->get();

        $cars = UserCar::where('user_id', $user_id)->get();
        $drivers = UserDriver::where('user_id', $user_id)->get();

        $applications = application::whereHas('answer', function ($q) {
            return $q->where('user_id', Auth::user()->id)
                ->where('status', 2);
        })
            ->where('user_id', $profile->id)
            ->get();

        $answers = answer::whereHas('ApplicationHas', function ($q) use ($profile) {
            return $q->where('user_id', Auth::user()->id);
        })
            ->where('user_id', $profile->id)
            ->where('status', 2)
            ->get();

        $canRewiew = false;
        if (!$applications->isEmpty() or !$answers->isEmpty()) $canRewiew = true;


        return view('lk.profile.show', compact('canRewiew'), [
            'profile' => $profile,
            'reviews' => $reviews,
            'cars' => $cars,
            'drivers' => $drivers
        ]);


    }


    //
    //Новая запись в вкладке Машины
    public function addNewCar(carRequest $request, $user_id)
    {

        $car = new UserCar;

        $car->car_number = $request->car_number;
        $car->user_id = $user_id;
        //Передняя сторона СТС
        if ($request->file('sts_front')) {
            $image = new ImageManager;
            //Уникальное имя изображения
            $md5Name = md5_file($request->file('sts_front')->getRealPath());
            $guessExtension = $request->file('sts_front')->guessExtension();

            $path = $request->file('sts_front')->storeAs('car_sts', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/car_sts/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();
            $car->sts_front = $md5Name . '.' . $guessExtension;
        }
        //Задняя сторона СТС
        if ($request->file('sts_back')) {
            $image = new ImageManager;
            //Уникальное имя изображения
            $md5Name = md5_file($request->file('sts_back')->getRealPath());
            $guessExtension = $request->file('sts_back')->guessExtension();

            $path2 = $request->file('sts_back')->storeAs('car_sts', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/car_sts/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();
            $car->sts_back = $md5Name . '.' . $guessExtension;
        }
        $car->save();
        return redirect()->back()->withInput();
    }

    //Удалить запись машины
    public function deleteCar($user_id, UserCar $car)
    {

        $car->delete();
        return redirect()->back()->withInput();
    }
    //
    //Новая запись в вкладке Водители
    public function addNewDriver(driverRequest $request, $user_id)
    {
        $driver = new UserDriver;

        $driver->name = $request->name;
        $driver->last_name = $request->last_name;
        $driver->middle_name = $request->middle_name;
        $driver->phone = $request->phone;
        $driver->user_id = $user_id;
        //
        //Фото водительсих прав
        if ($request->file('drive_front')) {
            $image = new ImageManager;
            //Уникальное имя изображения
            $md5Name = md5_file($request->file('drive_front')->getRealPath());
            $guessExtension = $request->file('drive_front')->guessExtension();

            $path = $request->file('drive_front')->storeAs('drive_licence', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/drive_licence/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();

            $driver->drive_front = $md5Name . '.' . $guessExtension;
        }
        if ($request->file('drive_back')) {
            $image = new ImageManager;
            //Уникальное имя изображения
            $md5Name = md5_file($request->file('drive_back')->getRealPath());
            $guessExtension = $request->file('drive_back')->guessExtension();

            $path = $request->file('drive_back')->storeAs('drive_licence', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/drive_licence/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();
            $driver->drive_back = $md5Name . '.' . $guessExtension;
        }
        //
        //Фото паспорта
        if ($request->file('passport_front')) {

            $image = new ImageManager;
            //Уникальное имя изображения
            $md5Name = md5_file($request->file('passport_front')->getRealPath());
            $guessExtension = $request->file('passport_front')->guessExtension();

            $path = $request->file('passport_front')->storeAs('drivers_passports', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/drivers_passports/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();

            $driver->passport_front = $md5Name . '.' . $guessExtension;
        }
        if ($request->file('passport_back')) {
            $image = new ImageManager;
            //Уникальное имя изображения
            $md5Name = md5_file($request->file('passport_back')->getRealPath());
            $guessExtension = $request->file('passport_back')->guessExtension();

            $path = $request->file('passport_back')->storeAs('drivers_passports', $md5Name . '.' . $guessExtension, 'private');
            $location = storage_path('app/private/drivers_passports/' . $md5Name . '.' . $guessExtension);

            $image->make($location)->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();

            })->save();
            $driver->passport_back = $md5Name . '.' . $guessExtension;
        }

        $driver->save();

        return redirect()->back()->withInput();

    }

    //Удалить запись водителя
    public function deleteDriver($user_id, UserDriver $driver)
    {

        $driver->delete();

        return redirect()->back()->withInput();
    }


    public function showEditFormProfile($user_id)
    {
        $profile = User::find($user_id);
        $group = User::GetGroup($user_id);

        $action = route('edit.user.profile', $user_id);
        $action_password = route('edit.user.password', $user_id);
        $method = 'post';


        return view('lk.profile.edit',
            compact('action', 'action_password', 'method', 'group'),
            ['profile' => $profile]);


    }

    public function editProfile(ProfileUpdateRequest $request, $user_id)
    {

        $profile = User::find($user_id);
        $group = User::GetGroup($user_id);

        $action = route('edit.user.profile', $user_id);
        $action_password = route('edit.user.password', $user_id);
        $method = 'post';


        $profile = User::find($user_id);
        $profile->name = $request->input('name');
        $profile->last_name = $request->input('last_name');
        $profile->middle_name = $request->input('middle_name');
        $profile->org = $request->input('org');
        $profile->email = $request->input('email');
        $profile->reg_address = $request->input('reg_address');
        // К верификации телефона


        $profile->inn = $request->input('inn');
        $profile->work_with_nds = $request->input('work_with_nds');

        if ($request->file('photo')) {

            $image = $request->file('photo');
            $path = public_path('media/avatars');
            $path2 = $image->store('media/avatars');
            $image->move($path, $image->hashName());
            $profile->photo = $path2;
        }

        $profile->save();

        $del = [' ', '(', ')', '-'];
        $phone = str_replace($del, '', $request->input('phone'));

        if ($profile->phone != $phone) {

            if (count(User::where('phone', $phone)->get())) {
                $message = 'Введенный Вами номер телефона уже существует в системе используйте другой номер';
                return redirect()->back()->withErrors($request->validator)->withInput();
                return view('lk.profile.edit', compact('action', 'action_password', 'method', 'group', 'message'), ['profile' => $profile]);
                //return redirect(url()->previous())


            }

            $profile->phone = $phone;
            $profile->phone_verified_at = NULL;
            $profile->save();
            $smsverify = new SmsVerificationController;
            $smsverify->updateCode($profile->id);
            return view('auth.smsverify');


        }

        return redirect()->back()->withErrors($request->validator)->withInput();
        return view('lk.profile.edit', compact('action', 'action_password', 'method', 'group'), ['profile' => $profile]);

    }


    public function setUserGroup(User $user_id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'group_id' => ['required', 'integer'],
        ]);

        $user_id->group_id = $request->input('group_id');
        $user_id->save();

        return redirect()->back()->withErrors($validator)->withInput();

    }

    public function updateNotificationSettings(Request $request, User $user_id)
    {

        if ($request->get('action') == 'n_answer_approve') {
            $user_id->n_answer_approve = $request->get('status');
            $user_id->save();
            return ['status' => 'success'];
        }

        if ($request->get('action') == 'n_new_answer') {
            $user_id->n_new_answer = $request->get('status');
            $user_id->save();
            return ['status' => 'success'];
        }

        if ($request->get('action') == 'n_new_app') {
            $user_id->n_new_app = $request->get('status');
            $user_id->save();
            return ['status' => 'success'];
        }


        return ['status' => 'fail'];


    }


    public function editPassword(Request $request, $user_id)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => ['required', 'string', 'min:5'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $action = route('edit.user.profile', $user_id);
        $action_password = route('edit.user.password', $user_id);


        $method = 'post';


        if (ResetPasswordController::changePassword($request->input('old_password'), $request->input('password'), $user_id)) {

            $profile = User::findOrFail($user_id);
            // сброс верификации
            $profile->phone_verified_at = NULL;
            $profile->save();
            $smsverify = new SmsVerificationController;
            $smsverify->updateCode($profile->id);
            return view('auth.smsverify');

            //return redirect($action)
            //->withErrors($validator)
            //->with('success', 'Пароль изменен');

        } else {

            $validator->getMessageBag()->add('old_password', 'Неверный пароль');
            return redirect($action)
                ->withErrors($validator)
                ->withInput();
        }

    }

    public function bankReqst($user_id, bankInfoRequest $request)
    {
        //Банковские реквизиты
        if ($bank = bankInfo::where('user_id', $user_id)->get()->first()) {
        } else {
            $bank = new bankInfo;
        }


        $bank->user_id = $user_id;
        $bank->bik = $request->bik;
        $bank->bank_name = $request->bank_name;
        $bank->bank_account = $request->bank_account;
        $bank->bank_account_number = $request->bank_account_number;

        $bank->save();
        return redirect()->back()->withInput();
    }

}
