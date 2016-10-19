<?php

use Illuminate\Database\Seeder;
use App\Models\Cart_status;

class CartStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                'name' => 'ON HOLD',
                'description' => 'Wachtend to checkout',
            ],
            [
                'name' => 'CHECKOUT',
                'description' => 'Wachtend op bevestiging betaling',
            ],
            [
                'name' => 'ORDERED',
                'description' => 'Checkout afgerond',
            ],
            [
                'name' => 'ERROR',
                'description' => 'Een fout of nog niet beschikbare status tijdens behandeling van order',
            ],
        ];

        foreach($statuses as $status){
            Cart_status::create($status);
        }

        //factory(Cart_status::class, DatabaseSeeder::AMOUNT['DEFAULT'])->create();
    }
}
