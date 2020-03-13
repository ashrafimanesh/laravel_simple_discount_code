<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class ApiTokenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:api_token {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get user token email=example@example.com';

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
        /** @var User $user */
        $user = User::where('email',$this->argument('email'))->first();
        $user ? $this->info('Token: '.$user->getApiToken()) : $this->error("User not found!");
    }
}
