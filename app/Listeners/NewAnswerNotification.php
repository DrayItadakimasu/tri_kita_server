<?php

namespace App\Listeners;

use App\Events\NewAnswer;
use App\clients\NotificationFcm;
use App\clients\NotificationApns;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

use App\Jobs\SendLongNotification;

class NewAnswerNotification implements ShouldQueue
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
     * @param NewAnswer $event
     * @return void
     */
    public function handle(NewAnswer $event)
    {
        //
        $driver = $event->answer->user;
        $answer = $event->answer;
        $application = $answer->application;
        $client = $application->client;

        $header = 'Новый ответ: ' . $application->culture->name . ' ' . $application->amount . "т.";
        $message = 'Водитель: ' . $driver->name . ' ' . $driver->last_name . ' Машин: ' . $answer->cars;
        $url = route('listing.answer', $application->id);

        if ($client->n_new_answer) {

            $tokensFcm = $client->fcm()->pluck('fcm_token')->toArray();
            $tokensApns = $client->apns()->pluck('apns_token')->toArray();

            if ($tokensFcm) {

                dispatch(new SendLongNotification($tokensFcm, $header, $message, $url));

            }

            if ($tokensApns) {

                Log::info('APNS New Event: Не реализовано ');

            }


        }

    }


}
