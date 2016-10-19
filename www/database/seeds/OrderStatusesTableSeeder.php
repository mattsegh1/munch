<?php

use Illuminate\Database\Seeder;
use App\Models\Order_status;

class OrderStatusesTableSeeder extends Seeder
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
                'description' => 'Wachtend op betaling',
            ],
            [
                'name' => 'TRANSPORT READY',
                'description' => 'Betaald en klaar om te worden verzonden naar de klant',
            ],
            [
                'name' => 'IN TRANSPORT',
                'description' => ' Stock verlaten en onderweg naar bestemming',
            ],
            [
                'name' => 'DELIVERED',
                'description' => 'Afgelevered aan de klant. Order is voltooid',
            ],
            [
                'name' => 'ERROR',
                'description' => 'Een fout of nog niet beschikbare status tijdens behandeling van order',
            ],
        ];

        foreach($statuses as $status){
            Order_status::create($status);
        }

        //factory(Order_status::class, DatabaseSeeder::AMOUNT['DEFAULT'])->create();
    }
}
