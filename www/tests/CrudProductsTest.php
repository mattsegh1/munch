<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CrudProductsTest extends TestCase
{
    public function testCreateProduct()
    {
        Artisan::call('munch:database:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');

        $this->authAdmin();

        $local_file = __DIR__ . '/test-files/product.jpg';

        $this->visit('product/create')
            ->see('Product toevoegen')
            ->type('Test Product', 'name')
            ->attach($local_file, 'image')
            ->select(1, 'manufacturer_id')
            ->select(2, 'category_id')
            ->type('Dit is een test beschrijving.', 'description')
            ->type(3, 'price')
            ->select(0, 'discount_id')
            ->select(5, 'tax_id')
            ->type(600, 'calories')
            ->press('Toevoegen');
        //->see('Product toegevoegd.');

        $this->seeInDatabase('products', [
            'name' => 'Test Product',
            'description' => 'Dit is een test beschrijving.',
            'quantity' => 0,
            'calories' => 600,
            'tax_id' => 5,
            'discount_id' => NULL,
            'price' => 3.00,
            'category_id' => 2,
            'manufacturer_id' => 1,
        ]);
    }

    public function authAdmin()
    {
        $admin = App\Models\Admin::find(1);

        $this->be($admin);
    }


}
