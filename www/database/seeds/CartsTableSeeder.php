<?php

use Illuminate\Database\Seeder;
use App\Models\Cart;

class CartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        $cart_items = [
            [
                'column' => 'value',
            ],
        ];

        foreach($cart_items as $item){
            Cart::create($item);
        }
        */

        factory(Cart::class, DatabaseSeeder::AMOUNT['DEFAULT'])->create();
    }
}
