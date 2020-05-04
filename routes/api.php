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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Users

// Route::get('/users', 'UsersController@index');

Route::prefix('v1')->namespace('Api\V1')->group(function() {

    Route::apiResource('users', 'UsersController');

    Route::prefix('users')->group(function() {

        Route::post('/getUserById', 'UsersController@getUserById')->name('users.getUserById');

        Route::post('/getUserByUsername', 'UsersController@getUserByUsername')->name('users.getUserByUserName');

        Route::post('/register', 'UsersController@store')->name('users.store');
    });

    // Categories

    Route::prefix('categories')->group(function() {

        Route::get('/', 'CategoriesController@index')->name('categories.index');

        Route::post('/getCategoryById', 'CategoriesController@getCategoryById')->name('categories.getCategoryById');

        Route::post('/store', 'CategoriesController@store')->name('categories.store');

        Route::put('/update/{category}', 'CategoriesController@update')->name('categories.update');

    });

    // Products

    Route::prefix('products')->group(function() {

        Route::get('/', 'ProductsController@index')->name('products.index');

        Route::post('/getProductById', 'ProductsController@getProductById')->name('products.getProductById');

        Route::post('/getProductByCategoryId', 'ProductsController@getProductByCategoryId')->name('products.getProductByCategoryId');

        Route::post('/store', 'ProductsController@store')->name('products.store');

        Route::put('/update/{product}', 'ProductsController@update')->name('products.update');

    });

});