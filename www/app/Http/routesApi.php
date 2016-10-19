<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/




Route::group([
    'middleware' => [
        'cors',
    ],
    'namespace' => 'Api',
    'prefix' => 'api/v1',
], function () {
    $options = [
        'except' => [
            'create',
            'edit'
        ]
    ];


    //Route::get('customers/{customer_id}/orders/{id}', 'OrdersController@show');

    Route::resource('products', 'ProductsController', $options);
    Route::resource('categories', 'CategoriesController', $options);
    Route::resource('customers', 'CustomersController', $options);
    Route::resource('users', 'UsersController', $options);
    Route::resource('customers/{customer_id}/orders', 'OrdersController', $options);


    //Route::get('customers/{customer_id}/orders/{id}', 'OrdersController@show');

    //customer

    //Route::get('customers/{customer_id}', 'CustomerController@show')->where('customer_id', '[0-9]+');
    //Route::get('customers', 'CustomerController@index');
    //Route::post('customers/{customer_id}/update', 'CustomerController@update')->where('customer_id', '[0-9]+');
    //Route::post('customers/{customer_id}', 'CustomerController@show')->where('customer_id', '[0-9]+');
});