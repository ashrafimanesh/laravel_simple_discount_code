<?php
/**
 * Created by PhpStorm.
 * User: ashrafimanesh@gmail.com
 * Date: 3/14/20
 * Time: 9:18 AM
 */

namespace App\Console\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AddUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:add-test-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add test user';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = Str::random(60);
        DB::table(\App\User::TABLE_NAME)->insert([
            'name' => $name,
            'email' => $name.'@test.com',
            'password' => Hash::make('test'),
            'api_token'=> Str::random(60)
        ]);
    }

}