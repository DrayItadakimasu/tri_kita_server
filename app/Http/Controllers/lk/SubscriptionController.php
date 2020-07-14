<?php

namespace App\Http\Controllers\lk;

use App\clients\SubscriptionLoad;
use App\clients\SubscriptionUnload;
use App\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\User;

class SubscriptionController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */

    public function show(User $user_id)
    {

        $subscriptionLoad = SubscriptionLoad::where('user_id', $user_id->id)->get();
        $subscriptionUnload = SubscriptionUnload::where('user_id', $user_id->id)->get();

        return view('lk.profile.notify',
            ['subscriptionLoad' => $subscriptionLoad,
                'subscriptionUnload' => $subscriptionUnload,
                'profile' => $user_id]);

    }


    public function storeLoadSubscribtion(Request $request, $user_id)
    {

        $validator = Validator::make($request->all(), [

            'load_region' => ['required', 'string', 'max:255'],
            'load_area' => ['nullable', 'string', 'max:255'],

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $subscription = new SubscriptionLoad;
        $subscription->user_id = $user_id;
        $subscription->load_region = $request->input('load_region');
        $subscription->load_area = $request->input('load_area');

        $subscription->save();


        return redirect()
            ->back()
            ->with('subscribe_unload_info', 'Подписка добавлена')
            ->withInput();

    }

    public function storeUnloadSubscribtion(Request $request, $user_id)
    {

        $validator = Validator::make($request->all(), [
            'unload_region' => ['required', 'string', 'max:255'],
            'unload_city' => ['nullable', 'string', 'max:255'],
            'unload_area' => ['nullable', 'string', 'max:255'],
            'unload_settlement' => ['nullable', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $subscription = new SubscriptionUnload;
        $subscription->user_id = $user_id;
        $subscription->unload_region = $request->input('unload_region');
        $subscription->unload_area = $request->input('unload_area');
        $subscription->unload_settlement = $request->input('unload_settlement');
        $subscription->unload_org = $request->input('unload_org');
        $subscription->save();


        return redirect()
            ->back()
            ->with('subscribe_unload_info', 'Подписка добавлена')
            ->withInput();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Subscription $subscription
     * @return Response
     */
    public function update($user_id, $type, $id, Request $request)
    {

        if ($type == 'load') {

            $subscription = SubscriptionLoad::findOrFail($id);
            if ($request->get('set_status') == 1) {
                $subscription->active = true;
                $subscription->save();
                return ['status' => 'success'];
            }

            if ($request->get('set_status') == 0) {
                $subscription->active = false;
                $subscription->save();
                return ['status' => 'success'];
            }
        }

        if ($type == 'unload') {

            $subscription = SubscriptionUnload::findOrFail($id);
            if ($request->get('set_status') == 1) {
                $subscription->active = true;
                $subscription->save();
                return ['status' => 'success'];
            }

            if ($request->get('set_status') == 0) {
                $subscription->active = false;
                $subscription->save();
                return ['status' => 'success'];
            }
        }

        return ['status' => 'fail'];

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Subscription $subscription
     * @return Response
     */
    public function destroy($user_id, $type, $id)
    {

        if ($type == 'load') {

            $subscription = SubscriptionLoad::findOrFail($id);
            if ($subscription->delete()) {

                return redirect()
                    ->back()
                    ->with('subscribe_load_info', 'Подписка удалена')
                    ->withInput();


            }
        }

        if ($type == 'unload') {

            $subscription = SubscriptionUnload::findOrFail($id);
            if ($subscription->delete()) {

                return redirect()
                    ->back()
                    ->with('subscribe_unload_info', 'Подписка удалена')
                    ->withInput();

            }
        }

        return redirect()
            ->back()
            ->with('subscribe_' . $type . '_error', 'Ошибка удаления')
            ->withInput();


    }
}
