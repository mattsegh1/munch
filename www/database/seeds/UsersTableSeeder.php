<?php

use Illuminate\Database\Seeder;
use App\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =
            [
                'username' => 'nmdad2',
                'email' => 'nmdad2_gebruiker@arteveldehs.be',
                'password' => bcrypt('nmdad2_wachtwoord'),
                'remember_token' => str_random(10),
            ];

            User::create($user);
        // Faker
        // -----
        factory(User::class, DatabaseSeeder::AMOUNT['DEFAULT'])->create();
    }
}
