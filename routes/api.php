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

Route::post('register', 'ApiController@register');
Route::post('login', 'ApiController@authenticate');

Route::group(['middleware' => ['jwt.verify']], 
    function() {
        Route::get('user', 'ApiController@getAuthenticatedUser');
        Route::get('products', 'ApiController@products')->name('api_products');
        Route::get('/categories/{category}/{product}', 'ApiController@product')->name('api_products');
});
