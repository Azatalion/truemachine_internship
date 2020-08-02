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

Route::group([
    'middleware' => ['auth', 'role:admin'],
    'namespace' => 'Admin',
    'prefix' => 'admin',
    ], function() {
        Route::resource('products', 'ProductController');
});

Route::get('/products/{product}', 'MainController@product')->name('product');
Route::get('/products', 'MainController@products')->name('products');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
