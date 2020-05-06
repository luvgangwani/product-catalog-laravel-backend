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

// Make sure to pass Accept header as application/json

Route::prefix('v1')->namespace('Api\V1')->group(function() {

    // Route::apiResource('users', 'UsersController');

    Route::prefix('users')->group(function() {

        Route::get('/', 'UsersController@index')
        ->middleware('auth:api', 'check.user.role:'.config('enums.role.ADMIN'))
        ->name('users.index');
        
        Route::post('/getUserById', 'UsersController@getUserById')
        ->middleware('auth:api')
        ->name('users.getUserById');

        Route::post('/getUserByUsername', 'UsersController@getUserByUsername')
        ->middleware('auth:api')
        ->name('users.getUserByUserName');

        Route::post('/register', 'AuthController@register')->name('users.register');

        Route::post('/login', 'AuthController@login')->name('users.login');

    });

    // Categories

    Route::prefix('categories')->group(function() {

        Route::get('/', 'CategoriesController@index')
        ->name('categories.index');

        Route::post('/getCategoryById', 'CategoriesController@getCategoryById')
        ->name('categories.getCategoryById');

        Route::post('/store', 'CategoriesController@store')
        ->middleware('auth:api', 'check.user.role:'.config('enums.role.ADMIN'))
        ->name('categories.store');

        Route::put('/update/{category}', 'CategoriesController@update')
        ->middleware('auth:api', 'check.user.role:'.config('enums.role.ADMIN'))
        ->name('categories.update');

    });

    // Products

    Route::prefix('products')->group(function() {

        Route::get('/', 'ProductsController@index')->name('products.index');

        Route::post('/getProductById', 'ProductsController@getProductById')->name('products.getProductById');

        Route::post('/getProductsByCategoryId', 'ProductsController@getProductsByCategoryId')->name('products.getProductsByCategoryId');

        Route::post('/store', 'ProductsController@store')
        ->middleware('auth:api', 'check.user.role:'.config('enums.role.ADMIN'))
        ->name('products.store');

        Route::put('/update/{product}', 'ProductsController@update')
        ->middleware('auth:api', 'check.user.role:'.config('enums.role.ADMIN'))
        ->name('products.update');

    });

});