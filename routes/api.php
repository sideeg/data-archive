<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// User App Api
//Route::group(['prefix' => 'users'], function () {
    Route::post('users/login', 'Api\UserController@login');
    Route::post('users/verifyOtp/{id}', 'Api\UserController@verifyOtp');

// post and get orders
    Route::get('orders/{users:id}', 'Api\UserController@Getorder');  // get old orders with token
    Route::post('orders', 'Api\UserController@Postorder');

// Pharmacy App Api
//Route::group(['prefix' => 'pharmacies'], function () {
    Route::post('pharmacies/register', 'Api\PharmacyController@register');
    Route::post('pharmacies/login', 'Api\PharmacyController@login');
    Route::post('pharmacies/response', 'Api\PharmacyController@response'); // 
//});
