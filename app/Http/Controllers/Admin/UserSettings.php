<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\clients\Rating;
use Illuminate\Support\Facades\Validator;

class UserSettings extends Controller
{
    public function show(User $user)
    {
        return view('admin.UserSettings', [
            'user' => $user
        ]);
    }

    public function edit(User $user, Request $request)
    {

        if ($request->has('rating')) {

            $validator = Validator::make($request->post(), [
                'rating' => ['numeric', 'max:5']
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $rating = $request->post('rating');
            if ($rating == 0) $rating = null;

            $data = [
                'fixed' => $rating,
                'register' => 0,
                'profile_info' => 0,
                'user_docs' => 0,
                'last_application' => 0,
                'all' => 0,
            ];

            if (Rating::updateOrCreate(['user_id' => $user->id], $data)) {
                $user->rating = $request->post('rating');
                $user->save();
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->with('success', 'Обновлено');

            }

        }


    }

}
