<?php

use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Dung Hua',
            'email' => 'dunghuava@outlook.com',
            'password' => bcrypt(12345678),
            'type' => 0 // 0. customer 1. Admin
        ]);
    }
}
