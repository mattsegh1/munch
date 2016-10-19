<?php

use Illuminate\Database\Seeder;
use App\Models\Product_history;

class ProductHistoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        $history = [
            [
                'product_id' => 1,
                'quantity' => 'Groenten',
                'price' => '3.20',
            ],
            [
                'product_id' => 1,
                'price' => '4.00',
            ],
            [
                'product_id' => 1,
                'quantity' => 'Zuivel',
            ],
        ];


        foreach($history as $item){
            Product_history::create($item);
        }
        */

        factory(Product_history::class, DatabaseSeeder::AMOUNT['MANY'])->create();
    }
}
