<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DB;
use Auth;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_name',
        'middle_name', 'org', 'phone', 'skype', 'work_with_nds',
        'group_id', 'photo', 'n_new_app', 'reg_address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function GetGroup($user_id)
    {
        $group_name = DB::table('user_groups')->where('id', $user_id)
            ->pluck('label')->first();

        return $group_name;

    }

    public function group()
    {
        return $this->belongsTo('App\UserGroup');
    }

    public function fcm()
    {
        return $this->hasMany('App\clients\NotificationFcm', 'user_id');
    }

    public function apns()
    {
        return $this->hasMany('App\clients\NotificationApns', 'user_id');
    }


    public function text_info()
    {
        return $this->hasOne('App\clients\saveText', 'user_id');
    }

    public function black_list()
    {
        return $this->hasMany('App\clients\bl', 'user_id');
    }

    public function getFioAttribute()
    {
        return $this->name . " " .
            $this->middle_name . " " .
            $this->last_name;
    }

    public function applications()
    {
        return $this->hasMany('App\clients\application', 'user_id');
    }


    public function getAnswersCountAttribute()
    {
        $applications = $this->applications()->has('answer')->with(['answer' => function ($q) {
            return $q->select('id');
        }])->get();
        $result = 0;
        foreach ($applications as $item) {
            if ($item->status == 1 && $item->date_end >= Carbon::today()) $result = $result + $item->answer->count();
        }
        return $result;
    }

    public function documents()
    {
        return $this->hasOne('App\userDocument');
    }

    public function cars()
    {
        return $this->hasOne('App\UserCar');
    }

    public function drivers()
    {
        return $this->hasOne('App\UserDriver');
    }

    public function banks()
    {
        return $this->hasOne('App\bankInfo');
    }

    public function rating()
    {
        return $this->hasOne('App\clients\Rating');
    }

    public function UserRating()
    {
        return $this->hasOne('App\clients\Rating');
    }

    public function SubscriptionLoad()
    {
        return $this->hasMany('App\clients\SubscriptionLoad', 'user_id', 'id');
    }

    public function SubscriptionUnload()
    {
        return $this->hasMany('App\clients\SubscriptionUnload', 'user_id', 'id');
    }

}
