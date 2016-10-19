<?php


use App\Models\Address;
use App\Models\Admin;
use App\Models\Cart;
use App\Models\Cart_status;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Discount;
use App\Models\Manufacturer;
use App\Models\Order;
use App\Models\Order_status;
use App\Models\Product;
use App\Models\Product_history;
use App\Models\Rating;
use App\Models\Tax;
use App\User;
use Faker\Generator as Faker;
use Faker\Provider as Provider;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Address::class, function (Faker $faker){
    return [
        'street' => $faker->streetAddress,
        CreateCitiesTable::FOREIGN_KEY => City::all()->random()->{CreateCitiesTable::PRIMARY_KEY},
        CreateCustomersTable::FOREIGN_KEY => Customer::all()->random()->{CreateCustomersTable::PRIMARY_KEY},
    ];
});

$factory->define(Admin::class, function (Faker $faker){
    return [
        'username' => $faker->unique()->userName,
        'password' => bcrypt(str_random(10)),
        'email' => $faker->unique()->safeEmail,
        'remember_token' => str_random(10),
        'deleted_at' => NULL,
    ];
});

$factory->define(Cart::class, function (Faker $faker){
    return [
        CreateCartStatusesTable::FOREIGN_KEY => Cart_status::all()->random()->{CreateCartStatusesTable::PRIMARY_KEY},
    ];
});

$factory->define(Cart_status::class, function (Faker $faker){
    return [
        'name' => strtoupper($faker->unique()->word),
        'description' => $faker->paragraph($sentences = 1),
    ];
});

$factory->define(Category::class, function (Faker $faker){
    return [
        'name' => $faker->unique()->word,
        'description' => $faker->paragraph($sentences = 3),
    ];
});

$factory->define(City::class, function (Faker $faker){
    //$faker->addProvider(new Provider\be_BE\Address($faker)); //NO be available for address
    return [
        'city' => $faker->unique()->city(),
        CreateCountriesTable::FOREIGN_KEY => Country::all()->random()->{CreateCountriesTable::PRIMARY_KEY},
    ];
});

$factory->define(Country::class, function (Faker $faker){
    return [
        'name' => 'Belgium',//$faker->unique()->country,
    ];
});

$factory->define(Customer::class, function (Faker $faker){
    return [
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName(),
        //FKs
        //CreateUsersTable::FOREIGN_KEY => User::all()->random()->{CreateUsersTable::PRIMARY_KEY},
        CreateUsersTable::FOREIGN_KEY => factory(App\User::class)->create()->id,
    ];
});

$factory->define(Discount::class, function (Faker $faker){
    return [
        'name' => $faker->unique()->word,
        'percentage' => $faker->numberBetween($min = 1, $max = 100) ,
        'discount_end' => $date = $faker->date($format = 'Y-m-d', $max = '+3 months'),
        'discount_start' => $faker->date($format = 'Y-m-d', $max = $date),
    ];
});

$factory->define(Manufacturer::class, function (Faker $faker){
    return [
        'name' => $faker->unique()->company(),
        'logo_url' => $faker->imageUrl($width = 640, $height = 480),
    ];
});

$factory->define(Order::class, function (Faker $faker){
    return [
        //FKs
        CreateOrderStatusesTable::FOREIGN_KEY => Order_status::all()->random()->{CreateOrderStatusesTable::PRIMARY_KEY},
        CreateCustomersTable::FOREIGN_KEY => Customer::all()->random()->{CreateCustomersTable::PRIMARY_KEY},
        CreateAddressesTable::FOREIGN_KEY => Address::all()->random()->{CreateAddressesTable::PRIMARY_KEY},

    ];
});

$factory->define(Order_status::class, function (Faker $faker){
    return [
        'name' => strtoupper($faker->unique()->word),
        'description' => $faker->paragraph($sentences = 1),
    ];
});

$factory->define(Product::class, function (Faker $faker){
    return [
        'name' => $faker->unique()->word,
        'description' => $faker->paragraph($sentences = 3),
        'price' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0.01, $max = 4),
        'quantity' => $faker->randomNumber($nbDigits = 3),
        'calories' => $faker->randomNumber($nbDigits = 2),
        'preview_url' => $faker->imageUrl($width = 640, $height = 480),

        CreateManufacturersTable::FOREIGN_KEY => Manufacturer::all()->random()->{CreateManufacturersTable::PRIMARY_KEY},
        CreateCategoriesTable::FOREIGN_KEY => Category::all()->random()->{CreateCategoriesTable::PRIMARY_KEY},
        CreateTaxesTable::FOREIGN_KEY => Tax::all()->random()->{CreateTaxesTable::PRIMARY_KEY},
        CreateDiscountsTable::FOREIGN_KEY => Discount::all()->random()->{CreateDiscountsTable::PRIMARY_KEY},
    ];
});

$factory->define(Product_history::class, function (Faker $faker){
    return [
        'quantity' => $faker->randomDigit(),
        'price' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 3),
        'created_at' => $faker->dateTimeThisYear($max = 'now'),
        CreateProductsTable::FOREIGN_KEY => Product::all()->random()->{CreateOrderStatusesTable::PRIMARY_KEY},
    ];
});

$factory->define(Rating::class, function (Faker $faker){
    return [
        'value' => $faker->numberBetween($min = 0, $max=10),
        CreateProductsTable::FOREIGN_KEY => Product::all()->random()->{CreateProductsTable::PRIMARY_KEY},
        CreateCustomersTable::FOREIGN_KEY => Customer::all()->random()->{CreateCustomersTable::PRIMARY_KEY},
    ];
});

$factory->define(Tax::class, function (Faker $faker){
    return [
        'title' => $faker->unique()->word,
        'description' => $faker->paragraph($sentences = 3),
        'tax_rate' => $faker->randomNumber($nbDigits = 2),
    ];
});

$factory->define(User::class, function (Faker $faker) {
    return [
        'username' => $faker->unique()->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'avatar_url' => $faker->imageUrl($width = 640, $height = 480),
    ];
});