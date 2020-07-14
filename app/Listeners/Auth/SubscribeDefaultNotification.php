<?php

namespace App\Listeners\Auth;

use App\Events\Auth\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\clients\SubscriptionLoad;

class SubscribeDefaultNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param UserRegistered $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        // подписка на Краснодарский край при регистрации
        $defaultSubscribe = new SubscriptionLoad;
        $defaultSubscribe->user_id = $event->user->id;
        $defaultSubscribe->load_region = "Краснодарский край";
        $defaultSubscribe->active = 1;
        $defaultSubscribe->save();

    }
}
