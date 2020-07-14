<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

use Illuminate\Support\Facades\Log;

class SendLongNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $header;
    protected $message;
    protected $tokens;
    protected $url;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $tokens, String $header, String $message, String $url)
    {
        $this->tokens = $tokens;
        $this->message = $message;
        $this->header = $header;
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        if (count($this->tokens) > 499) {
            Log::error('FCM SendLongNotification: массив переполнен, максимальное число получателей - 499');
        } else {


            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60 * 20);

            $notificationBuilder = new PayloadNotificationBuilder($this->header);
            $notificationBuilder->setBody($this->message)
                ->setSound('default');

            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData(['UrlWeb' => $this->url]);

            $option = $optionBuilder->build();
            $notification = $notificationBuilder->build();
            $data = $dataBuilder->build();


            $downstreamResponse = FCM::sendTo($this->tokens, $option, $notification, $data);

            if ($downstreamResponse->numberSuccess())
                Log::info('FCM SendLongNotification: success ' . $downstreamResponse->numberSuccess());
            if ($downstreamResponse->numberFailure()) {
                Log::error('FCM SendLongNotification: error ' . $downstreamResponse->numberFailure());
            }

            $downstreamResponse->numberModification();

        }


    }
}
