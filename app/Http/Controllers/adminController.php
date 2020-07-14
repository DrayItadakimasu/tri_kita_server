<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\userDocument;
use Auth;
use App\User;
use App\UserCar;
use App\Http\Requests\carRequest;
use App\UserDriver;

class adminController extends Controller
{
    public function showUsers()
    {
        $users_count = User::all()->count();
        $drivers_count = User::where('group_id', 3)->count();
        $customer_count = User::where('group_id', 2)->count();


        $documents = UserDocument::where('verify', 1)->paginate(10);

        return view('admin.verify-users', [
            'documents' => $documents,
            //Статистика пользователей
            'users_count' => $users_count,
            'drivers_count' => $drivers_count,
            'customer_count' => $customer_count

        ]);
    }

    public function verifyUser(UserDocument $document)
    {
        $document->verify = 2;
        $document->save();
        return redirect()->back()->withInput();
    }

    public function showCars()
    {
        $users_count = User::all()->count();
        $drivers_count = User::where('group_id', 3)->count();
        $customer_count = User::where('group_id', 2)->count();

        $user = UserCar::where('verify', 1)->paginate(10);

        return view('admin.verify-cars', [
            'user' => $user,
            //Статистика пользователей
            'users_count' => $users_count,
            'drivers_count' => $drivers_count,
            'customer_count' => $customer_count

        ]);
    }

    public function verifyCar(UserCar $car)
    {
        $car->verify = 2;
        $car->save();
        return redirect()->back()->withInput();
    }

    public function showDrivers()
    {
        $users_count = User::all()->count();
        $drivers_count = User::where('group_id', 3)->count();
        $customer_count = User::where('group_id', 2)->count();

        $user = UserDriver::where('verify', 1)->paginate(10);

        return view('admin.verify-drivers', [
            'user' => $user,
            //Статистика пользователей
            'users_count' => $users_count,
            'drivers_count' => $drivers_count,
            'customer_count' => $customer_count

        ]);
    }

    public function verifyDriver(UserDriver $driver)
    {
        $driver->verify = 2;
        $driver->save();
        return redirect()->back()->withInput();
    }
}
