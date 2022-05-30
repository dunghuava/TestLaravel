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
            'email' => 'dunghua@outlook.com',
            'password' => bcrypt(12345678),
            'type' => 0
        ]);

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@outlook.com',
            'password' => bcrypt(12345678),
            'type' => 1
        ]);

        $faker = Faker\Factory::create();
        for ($i = 0; $i < 100; $i++) {
            $name = $faker->name;
            \App\Product::create([
                'name' => $name,
                'alias' => str_slug($name),
                'description' => $faker->paragraph(100)
            ]);
        }
    }
}
