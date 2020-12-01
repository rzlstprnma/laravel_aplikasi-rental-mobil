<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('cars', 'carController');
    Route::resource('brands', 'brandController');
    Route::resource('clients', 'clientController');
    Route::resource('bookings', 'bookingController');
    Route::post('/bookings/calculate', 'bookingController@calculate');
    Route::post('/bookings/process', 'bookingController@process');
    Route::get('/returns', 'returnController@index');
    Route::get('/return/{code}', 'returnController@show');
    Route::post('/return/store', 'returnController@store');
    Route::get('/transaction', 'reportController@index');
    // data 
    Route::get('/api/brands', 'brandController@data')->name('api.brands');

    Route::get('/logout', 'HomeController@logout');
});
