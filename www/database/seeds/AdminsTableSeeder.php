<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fixed Data
        Admin::create([
            'username' => 'munch_admin',
            'password' => bcrypt('wachtwoord'),
            'email' => 'admin@munch.be',
        ]);

        // Faker
        // -----
        factory(Admin::class, DatabaseSeeder::AMOUNT['DEFAULT'])->create();
    }
}
