<?php

use Illuminate\Database\Seeder;
use App\Models\Rating;
use App\Models\Product;
use App\Models\Customer;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(Rating::class, DatabaseSeeder::AMOUNT['DEFAULT'])->create();
        $customerIds = Customer::pluck('id');
        $productIds = Product::pluck('id');

        foreach($customerIds as $customerId)
        {
            //random seed (not all users will be present this way.
            if(rand(0,1)){
                for($i = 0; $i < rand(1,count($productIds)); $i++) {
                    $productId = $productIds[$i];

                    Rating::create([
                        'value' => rand(0,5),
                        'customer_id' => $customerId,
                        'product_id' => $productId,
                    ]);
                }
            }
        }
    }
}
