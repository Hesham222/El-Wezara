<?php

use Illuminate\Support\Facades\Route;

Route::namespace('User\Http\Controllers')->prefix('api')->middleware(['api', 'localization'])->group(function () {
    Route::middleware(['hasDevice'])->group(function () {
        Route::post('register', 'AuthController@register')->middleware('throttle:6,1');
        Route::post('resend/code', 'AuthController@resendCode')->middleware('throttle:6,1');
        Route::post('forgot/password', 'AuthController@forgotPassword')->middleware('throttle:6,1');
        Route::post('login', 'AuthController@login')->middleware('throttle:6,1');
        Route::post('login/provider', 'AuthController@loginProvider');
        Route::post('reset/forgot/password', 'AuthController@changeForgotPassword');
        Route::post('verify/registration/code', 'AuthController@verifyCode');
    });

    Route::middleware('auth:api')->group(function () {
        Route::post('logout', 'AuthController@logout');

        Route::prefix('profile')->group(function () {
            Route::get('/', 'ProfileController@index');
            Route::post('/', 'ProfileController@update');
            Route::post('change/password', 'ProfileController@changePassword');
            Route::post('update/firebaseToken', 'FirebaseTokenController');
            // Route::get('notifications', 'NotificationController');
        });
    });
});
