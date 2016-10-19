<?php

use Illuminate\Database\Seeder;
use App\Models\Discount;

class DiscountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(Discount::class, DatabaseSeeder::AMOUNT['DEFAULT'])->create();
    }
}
