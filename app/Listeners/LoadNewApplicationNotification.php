<?php

namespace App\Listeners;

use App\Events\NewApplication;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\clients\application;
use App\clients\SubscriptionLoad;
use App\clients\SubscriptionUnload;
use App\Jobs\SendLongNotification;
use Illuminate\Support\Facades\Log;


class LoadNewApplicationNotification implements ShouldQueue
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
     * @param NewApplication $event
     * @return void
     */
    public function handle(NewApplication $event)
    {
        // заявка
        $application = $event->application;
        // число сообщений отправляемых за один раз
        $countMessages = 499;
        // получатели
        $tokens = array();
        // сообщение
        $header = "Заявка: " .
            $application->culture->name . ' ' .
            $application->amount . ' т. ' .
            $application->cost . ' руб./кг. ' .
            $application->distance . ' км.';

        $message = $application->load_full_address . ' -> ' .
            $application->unload_full_address;

        $url = route('show.application', $application->id);

        // Получаем подписчиков
        // --------- Погрузка ---------------------
        // Регион погрузки и район погрузки
        $subsribers = SubscriptionLoad::where([
            ['active', 1],
            ['user_id', '<>', $application->user_id]
        ])
            ->where(function ($q) use ($application) {
                return
                    $q->where(function ($q) use ($application) {
                        return $q
                            ->where('load_area', $application->load_area)
                            ->where('load_region', $application->load_region);
                    })
                        ->orWhere(function ($q) use ($application) {
                            return $q
                                ->whereNull('load_area')
                                ->where('load_region', $application->load_region);
                        });

            }) // получаем токены по каждой подписке
            ->with(['Fcm' => function ($q) {
                return $q->select(['fcm_token']);
            }])->get();

        //Формируем общий массив токенов получателей

        foreach ($subsribers as $subscriber) {
            foreach ($subscriber->fcm as $item) {
                $tokens[] = $item->fcm_token;

            }
        }
        // -------- Выгрузка ---------------------------
        // Регион, район, населенный пункт, организация
        // dd($application);
        $subsribers = SubscriptionUnload::where([
            ['active', 1],
            ['user_id', '<>', $application->user_id]
        ])
            ->where(function ($q) use ($application) {
                return $q->where(function ($q) use ($application) {
                    return $q
                        ->where('unload_org', $application->unload_place)
                        ->where('unload_settlement', $application->unload_full_address)
                        ->where('unload_area', $application->unload_area)
                        ->where('unload_region', $application->unload_region);
                })
                    ->orWhere(function ($q) use ($application) {
                        return $q
                            ->whereNull('unload_org')
                            ->where('unload_settlement', $application->unload_full_address)
                            ->where('unload_area', $application->unload_area)
                            ->where('unload_region', $application->unload_region);
                    })
                    ->orWhere(function ($q) use ($application) {
                        return $q
                            ->whereNull('unload_org')
                            ->whereNull('unload_settlement')
                            ->where('unload_area', $application->unload_area)
                            ->where('unload_region', $application->unload_region);
                    })
                    ->orWhere(function ($q) use ($application) {
                        return $q
                            ->whereNull('unload_org')
                            ->whereNull('unload_settlement')
                            ->whereNull('unload_area')
                            ->where('unload_region', $application->unload_region);
                    })
                    ->orWhere(function ($q) use ($application) {
                        return $q
                            ->whereNull('unload_org')
                            ->where('unload_settlement', $application->unload_full_address)
                            ->whereNull('unload_area')
                            ->where('unload_region', $application->unload_region);
                    })
                    ->orWhere(function ($q) use ($application) {
                        return $q
                            ->where('unload_org', $application->unload_place)
                            ->where('unload_settlement', $application->unload_full_address)
                            ->whereNull('unload_area')
                            ->where('unload_region', $application->unload_region);
                    });

            }) // получаем токены по каждой подписке
            ->with(['Fcm' => function ($q) {
                return $q->select(['fcm_token']);
            }])->get();

        //Формируем общий массив токенов получателей

        foreach ($subsribers as $subscriber) {
            foreach ($subscriber->fcm as $item) {
                $tokens[] = $item->fcm_token;

            }
        }

        // Получаем подписчиков по параметру - все заявки
        // 31-03-20 - исправление проблемы с дублированием
        // Тестовый функционал

        $subsribers = User::where([
            ['n_new_app', 1],
            ['id', '<>', $application->user_id]
        ])
            // получаем токены по каждой подписке
            ->with(['Fcm' => function ($q) {
                return $q->select(['fcm_token']);
            }])->get();

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
