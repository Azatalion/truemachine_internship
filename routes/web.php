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

Route::get('/categories', 'Controller@categories')->name('categories');
Route::get('/categories/{category}', 'Controller@category')->name('category');
Route::get('/categories/{category}/{product}', 'Controller@product')->name('product');
Route::get('/products', 'Controller@products')->name('products');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
