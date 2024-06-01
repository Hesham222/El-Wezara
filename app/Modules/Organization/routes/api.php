<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Org Routes
|--------------------------------------------------------------------------
|
| Here is where you can register user modules routes for your application. These
| routes are loaded by the UserServiceProvider. Now create something great!
|
*/


Route::namespace('Organization\Http\Controllers')->prefix('api')->middleware(['api'])->group(function () {

    Route::post('login', 'AuthApiController@login');


});
