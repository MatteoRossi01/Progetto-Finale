<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function() {

    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('items', 'ItemController');

    //rotta per braintree
    Route::get('/payment/make', 'PaymentsController@make')->name('payment.make');

    //Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    //Route::post('register', 'Auth\RegisterController@register');

});

Route::get('{any?}', function() {
    return view('guest.home');
})->where('any', '.*');
