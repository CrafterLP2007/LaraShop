<?php

namespace App\Console\Commands\Admin;

use App\Models\User;
use Illuminate\Console\Command;

class CreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ls:admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'test@local.host',
            'password' => bcrypt('password'),
            'phone_number' => '0123456789',
            'address' => 'Teststraße 1',
            'zip' => '12345',
            'country' => 'DE',
            'two_factor_enabled' => false,
            'two_factor_secret' => null,
        ]);
    }
}
