<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\User;
use App\clients\SubscriptionLoad;


class UpdateUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $start;
    protected $end;

    // Данный класс предназначен для массового обновления информации
    // пользователей связаных с ними
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($start = 0, $end = 50)
    {
        $this->start = $start;
        $this->end = $end;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // данный класс предназначен для массового обновления пользователей
        $users = User::whereBetween('id', [$this->start, $this->end])
            ->select('id')
            ->whereDoesntHave(
                'SubscriptionLoad', function ($q) {
                return $q
                    ->select('id', 'user_id', 'load_region')
                    ->where('load_region', 'Краснодарский край');
            }
            )->get();


        foreach ($users as $user) {

            //Дефолтные значения

            $newSubscribe = new SubscriptionLoad;
            $newSubscribe->user_id = $user->id;
            $newSubscribe->active = 1;
            $newSubscribe->load_region = 'Краснодарский край';
            $newSubscribe->save();


        }
    }
}
