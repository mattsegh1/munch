<?php

use Illuminate\Database\Seeder;
use App\Models\Tax;

class TaxesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Tax::class, DatabaseSeeder::AMOUNT['DEFAULT'])->create();
    }
}
