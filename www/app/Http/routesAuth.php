<?php

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::group([
    'middleware' => [
        'auth',
    ],
], function () {

    //Category Routes
    Route::get('category', 'Dashboard\CategoryController@index'); // Read
    Route::get('category/create', 'Dashboard\CategoryController@create'); // Create
    Route::post('category/all', 'Dashboard\CategoryController@store'); // Persist Create
    Route::get('category/{id}', 'Dashboard\CategoryController@show'); // Read 1
    Route::put('category/{id}', 'Dashboard\CategoryController@update'); //Update
    Route::delete('category/{id}', 'Dashboard\CategoryController@soft_delete'); //Soft Delete
    Route::get('category/{id}/edit', 'Dashboard\CategoryController@edit'); //Edit Form

    //Customers Routes
    Route::get('customer', 'Dashboard\CustomerController@index'); // Read all
    Route::get('customer/create', 'Dashboard\CustomerController@create'); //Create
    Route::post('customer', 'Dashboard\CustomerController@store'); // Persist Create
    Route::get('customer/all/sort={type}', 'Dashboard\CustomerController@sort'); //Sort
    Route::get('customer/{id}', 'Dashboard\CustomerController@show'); //Read 1
    Route::put('customer/{id}', 'Dashboard\CustomerController@update'); //Update
    Route::delete('customer/{id}', 'Dashboard\CustomerController@soft_delete'); //Soft Delete
    Route::get('customer/{id}/edit', 'Dashboard\CustomerController@edit'); //Edit Form

    //Discount
    Route::get('discount/create', 'Dashboard\DiscountController@create'); //Create
    Route::post('discount', 'Dashboard\DiscountController@store'); //Persist Create

    //Manufacturer Routes
    Route::get('manufacturer', 'Dashboard\ManufacturerController@index'); // Read all
    Route::get('manufacturer/create', 'Dashboard\ManufacturerController@create'); //Create
    Route::post('manufacturer', 'Dashboard\ManufacturerController@store'); // Persist Create
    Route::get('manufacturer/{id}', 'Dashboard\ManufacturerController@show'); //Read 1
    Route::get('manufacturer/{id}/edit', 'Dashboard\ManufacturerController@edit'); //Edit Form
    Route::put('manufacturer/{id}', 'Dashboard\ManufacturerController@update'); //Update
    Route::delete('manufacturer/{id}', 'Dashboard\ManufacturerController@soft_delete'); //Soft Delete

    //Order Routes
    Route::get('order', 'Dashboard\OrderController@index'); // Read all
    Route::get('order/{id}', 'Dashboard\OrderController@show'); //Read 1
    Route::get('order/{id}/edit', 'Dashboard\OrderController@edit'); //Edit Form
    Route::put('order/{id}', 'Dashboard\OrderController@update'); //Update

    //Ratings
    Route::get('rating', 'Dashboard\RatingController@index');

    //Products Routes
    Route::get('product', 'Dashboard\ProductController@index'); //Read
    Route::get('product/create', 'Dashboard\ProductController@create'); //Create
    Route::post('product', 'Dashboard\ProductController@store'); // Persist Create
    Route::get('product/{id}', 'Dashboard\ProductController@show'); //Read 1
    Route::put('product/{id}', 'Dashboard\ProductController@update'); //Update
    Route::delete('product/{id}', 'Dashboard\ProductController@soft_delete'); //Soft Delete
    Route::get('product/{id}/edit', 'Dashboard\ProductController@edit'); //Edit Form
});