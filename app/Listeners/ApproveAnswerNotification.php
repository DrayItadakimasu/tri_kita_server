<?php

namespace App\Listeners;

use App\clients\NotificationFcm;
use App\clients\NotificationApns;

use App\Events\ApproveAnswer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

use App\Jobs\SendLongNotification;


class ApproveAnswerNotification implements ShouldQueue
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
     * @param ApproveAnswer $event
     * @return void
     */
    public function handle(ApproveAnswer $event)
    {
        $driver = $event->answer->user;
        $answer = $event->answer;
        $application = $answer->application;
        $client = $application->client;

        $header = 'Ваше предложение одобрено';
        $message = $client->org . ' Культура: ' . $application->culture->name . ' ' . $application->amount . " т. " . $application->distance . " км.";
        $url = route('show.application', $application->id);

        if ($driver->n_answer_approve) {

            $tokensFcm = $driver->fcm()->pluck('fcm_token')->toArray();
            $tokensApns = $driver->apns()->pluck('apns_token')->toArray();

            if ($tokensFcm) {

                dispatch(new SendLongNotification($tokensFcm, $header, $message, $url));

            }

            if ($tokensApns) {

                Log::info('APNS aproove: Не реализовано ');

            }


        }
    }
}
