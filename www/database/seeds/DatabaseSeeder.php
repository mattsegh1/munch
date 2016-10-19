<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    const AMOUNT = [
        'NONE' => 0,
        'MIN' => 1,
        'FEW' => 3,
        'SOME' => 5,
        'DEFAULT' => 10,
        'MANY' => 100,
        'MAX' => 1000,
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeder order is important for database relations!
        $seeders = [
            AdminsTableSeeder::class,
            UsersTableSeeder::class,

            CustomersTableSeeder::class,

            CountriesTableSeeder::class,
            CitiesTableSeeder::class,
            AddressesTableSeeder::class,

            OrderStatusesTableSeeder::class,
            OrdersTableSeeder::class,

            CartStatusesTableSeeder::class,
            CartsTableSeeder::class,

            ManufacturersTableSeeder::class,
            CategoriesTableSeeder::class,
            TaxesTableSeeder::class,
            DiscountsTableSeeder::class,
            ProductsTableSeeder::class,
            RatingsTableSeeder::class,

            ProductHistoriesTableSeeder::class,

        ];

        $i = 0;
        foreach ($seeders as $seeder) {
            $count = sprintf('%02d', ++$i);
            $this->command->getOutput()->writeln("<comment>Seed${count}:</comment> ${seeder}...");
            $this->call($seeder);
        }
    }
}
