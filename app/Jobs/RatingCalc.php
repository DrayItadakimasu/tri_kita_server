<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\User;
use App\clients\Rating;
use Carbon\Carbon;


class RatingCalc implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $start;
    protected $end;

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
        $users = User::whereBetween('id', [$this->start, $this->end])
            ->select('id', 'created_at', 'middle_name', 'org', 'email', 'photo', 'rating', 'rating_update')
            ->with([
                'applications' => function ($q) {
                    return $q
                        ->where('created_at', '<', Carbon::now()->subDays(14))
                        ->select('created_at', 'id', 'user_id');
                },
                'documents',
                'UserRating'
            ])->get();


        foreach ($users as $user) {

            // пропустить если есть фиксированные
            if (isset($user->UserRating->fixed)) {
                if ($user->UserRating->fixed <> NULL) continue;
            }

            //Дефолтные значения
            $data = [
                'register' => 0,
                'profile_info' => 0,
                'user_docs' => 0,
                'last_application' => 0,
                'all' => 0,
            ];


            $userRegisterDate = Carbon::parse($user->created_at)->timestamp;

            if (!$user->applications->isEmpty()) {
                $lastApplicationDate = Carbon::parse($user->applications()->latest()->first()->created_at)->timestamp;

                if (Carbon::now()->subDays(14)->timestamp < $lastApplicationDate) {
                    $data['last_application'] = 0.5;
                }

                if (Carbon::now()->subDays(7)->timestamp < $lastApplicationDate) {
                    $data['last_application'] = 1;
                }

            }


            // Расчет рейтинга
            if (Carbon::now()->subMonth(6)->timestamp > $userRegisterDate) {
                $data['register'] = 0.5;
            }
            if (Carbon::now()->subMonth(12)->timestamp > $userRegisterDate) {
                $data['register'] = 1;
            }

            if ($user->documents) {
                $data['user_docs'] = 1;
            }
            if ($user->middle_name && $user->org && $user->email && $user->photo) {
                $data['profile_info'] = 0.5;
            }

            $data['all'] = array_sum($data);

            $user->rating = $data['all'];
            $user->rating_update = Carbon::now();
            $user->save();

            // Обновление или создание
            Rating::updateOrCreate(['user_id' => $user->id], $data);

        }
    }
}
