<?php

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Order::create([
            'column' => 'value',
        ]);*/

        factory(Order::class, DatabaseSeeder::AMOUNT['DEFAULT'])->create();
    }
}
