<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\User;
use App\Jobs\UpdateUsers;

class StartUpdateAllUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $count;
    // Данный класс предназначен для формирования списка пользователей
    // для массового обновления информации связаных с ними


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($count)
    {
        $this->count = $count;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // получение всех пользователей
        $users = User::select('id')
            ->get()
            ->sortby('id')
            ->pluck('id')
            ->toArray();

        $users = array_chunk($users, $this->count);

        foreach ($users as $userChunk) {
            dispatch(
                (new UpdateUsers(array_shift($userChunk), array_pop($userChunk)))->onQueue('rating')
            );
        }

    }
}
