<?php

use Illuminate\Database\Seeder;
use App\Models\Manufacturer;

class ManufacturersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Manufacturer::class, DatabaseSeeder::AMOUNT['DEFAULT'])->create();
    }
}
