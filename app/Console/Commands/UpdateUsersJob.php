<?php

namespace App\Console\Commands;

use App\Jobs\StartUpdateAllUsers;
use Illuminate\Console\Command;

class UpdateUsersJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Запуск процесса обновления пользователей';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // обновление по 50
        dispatch((new StartUpdateAllUsers(50)));
    }
}
