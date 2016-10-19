<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Groenten',
                'description' => '',
            ],
            [
                'name' => 'Fruit',
                'description' => '',
            ],
            [
                'name' => 'Zuivel',
                'description' => '',
            ],
            [
                'name' => 'Vlees',
                'description' => '',
            ],
        ];

        foreach($categories as $category){
            Category::create($category);
        }

        //factory(Category::class, DatabaseSeeder::AMOUNT['DEFAULT'])->create();
    }
}
