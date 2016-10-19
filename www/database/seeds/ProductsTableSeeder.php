<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = Order::all();
        $carts = Cart::all();
        //factory(Product::class, DatabaseSeeder::AMOUNT['MANY'])->create();

        factory(Product::class, DatabaseSeeder::AMOUNT['DEFAULT'])->create()
            //FK
            ->each(function ($product) use ($orders) {
                $amount = rand(DatabaseSeeder::AMOUNT['MIN'], DatabaseSeeder::AMOUNT['DEFAULT']);
                $product->orders()->attach($orders->random($amount));
            })
            ->each(function ($product) use ($carts) {
                $amount = rand(DatabaseSeeder::AMOUNT['MIN'], DatabaseSeeder::AMOUNT['DEFAULT']);
                $product->carts()->attach($carts->random($amount));
            });

        //fill additonal column(s) pivot table
        $ids = DB::table('order_product')->select('order_id','product_id')->get();
        foreach($ids as $id)
        {
            DB::table('order_product')->where('order_id','=',$id->order_id)
                                      ->where('product_id','=',$id->product_id)
                                      ->update([
                                          'quantity' => rand(1, 50),
                                      ]);
        }

        $ids = DB::table('cart_product')->select('cart_id','product_id')->get();
        foreach($ids as $id)
        {
            DB::table('cart_product')->where('cart_id','=',$id->cart_id)
                ->where('product_id','=',$id->product_id)
                ->update([
                    'quantity' => rand(1, 50),
                ]);
        }
    }
}
