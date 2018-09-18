<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $faker = \Faker\Factory::create();
        $password = Hash::make('password');

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            User::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'password' => $password,
                'token' => null,
                'email' => $faker->email,
            ]);
        }
    }
}
