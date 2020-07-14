<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use DB;
use Illuminate\Validation\Rule;
use App\Events\Auth\UserRegistered;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/lk';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'reg_address' => ['required', 'string', 'max:255'],
            //'middle_name' => ['required', 'string', 'max:255'],
            'org' => ['nullable', 'string', 'max:255'],
            'phone' => 'required|unique:users,phone',
            'group_id' => ['required', 'string'],
            //'group_id' => 'exists:user_groups,allow_register',
            //'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User
     */
    protected function create(array $data)
    {
        $del = [' ', '(', ')', '-'];
        $phone = str_replace($del, '', $data['phone']);

        return User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            //'middle_name' => $data['middle_name'],
            'reg_address' => $data['reg_address'],
            'org' => $data['org'],
            'phone' => $phone,
            //'email' => $data['email'],
            'group_id' => $data['group_id'],
            'password' => Hash::make($data['password']),
            'n_new_app' => 1
        ]);
    }

    public function showRegistrationForm()
    {
        if (Schema::hasTable('user_groups')) {

            $groups = DB::table('user_groups')->where('allow_register', '=', 1)->get()->sortbydesc('id');

            return view('auth.register', ['groups' => $groups]);

        } else return view('auth.register');
    }

    protected function registered(Request $request, $user)
    {

        event(new UserRegistered($user));
        return redirect('/lk');

    }


}
