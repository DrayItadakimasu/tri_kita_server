<?php

namespace App\Listeners;

use App\Events\NewNewsLetter;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use App\Jobs\SendLongNotification;

class NewsLetterNotification
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
     * @param NewNewsLetter $event
     * @return void
     */
    public function handle(NewNewsLetter $event)
    {
        // Рассылка
        $newsLetter = $event->newsLetter;
        // число сообщений отправляемых за один раз
        $countMessages = 499;
        // получатели
        $tokens = array();
        // сообщение
        $header = $newsLetter->title;
        $message = $newsLetter->content;
        $params = json_decode($newsLetter->params);
        $url = $params->url;

        Log::info('Рассылка произведена');
        Log::info($header);
        Log::info($params->url);

        // Получаем подписчиков по параметру - все заявки
        $subsribers = $event->users
            // получаем токены по каждой подписке
            ->load(['Fcm' => function ($q) {
                return $q->select(['fcm_token']);
            }]);

        //Формируем общий массив токенов получателей

        foreach ($subsribers as $subscriber) {
            foreach ($subscriber->fcm as $item) {
                $tokens[] = $item->fcm_token;

            }
        }


        // уникализируем массив получателей
        $tokens = array_unique($tokens);

        // Формируем задачи в очередь
        // Если токнов больше чем сообщений отправляемых за 1 раз
        // То разбиваем массив и создаем несколько задач
        if (count($tokens) > 0) {
            if (count($tokens) > $countMessages) {
                $tokens = array_chunk($tokens, $countMessages);
                foreach ($tokens as $tokenChunk) {
                    dispatch(new SendLongNotification($tokenChunk, $header, $message, $url));
                }
            } else {
                // если нет тоставим 1 задачу
                dispatch(new SendLongNotification($tokens, $header, $message, $url));
            }
        }

        //var_dump($tokens);
        //die();
    }
}
