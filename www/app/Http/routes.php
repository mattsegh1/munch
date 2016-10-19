<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {

    
    require_once 'routesApi.php';
    //require_once 'routesWeb.php';
    require_once 'routesAuth.php';

    Route::auth();
    Route::get('/', 'HomeController@index');
});