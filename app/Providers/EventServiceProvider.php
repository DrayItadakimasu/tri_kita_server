<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\NewAnswer' => [
            'App\Listeners\NewAnswerNotification',
        ],
        'App\Events\ApproveAnswer' => [
            'App\Listeners\ApproveAnswerNotification',
        ],

        'App\Events\NewApplication' => [
            'App\Listeners\LoadNewApplicationNotification',
            //'App\Listeners\NewApplicationNotification',
        ],
        'App\Events\Auth\UserRegistered' => [
            'App\Listeners\Auth\SubscribeDefaultNotification',
        ],
        'App\Events\NewNewsLetter' => [
            'App\Listeners\NewsLetterNotification',
        ]

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
