<?php


use Illuminate\Support\Facades\Config;
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
//$organization_id = Request::segment(2); //fetches first URI segment
Config::set('auth.defines', 'organization_admin');
Route::namespace('Organization\Http\Controllers')->group(function () {
    app()->setLocale('ar');
    Route::post('adminLogin', 'AuthApiController@adminLogin');
});
Route::group(['middleware' => ['api', 'initDBApi']],function(){

    Route::namespace('Organization\Http\Controllers')->group(function (){

      //  Route::get('login', 'AuthApiController@login');

        app()->setLocale('ar');


       Route::group(['middleware' => ['VerifyApiToken']],function(){

            Route::get('logout', 'AuthApiController@logout');

            Route::get('pointOfSales', 'PointOfSaleApiController@listPointOfSales');

            Route::get('checkSheetPointOfSale', 'PointOfSaleApiController@checkSheet');
            Route::get('getItemCategory', 'PointOfSaleApiController@getItemCategory');

            Route::post('startSheet', 'PointOfSaleApiController@startSheet');
            Route::post('endSheet', 'PointOfSaleApiController@endSheet');
            Route::post('getPoItems', 'PointOfSaleApiController@getPoItems');

      // cart apis
        Route::post('viewCart', 'PointOfSaleApiController@viewCart');

        Route::post('addToCart', 'PointOfSaleApiController@addToCart');
        Route::post('deleteAllCart', 'PointOfSaleApiController@deleteAllCart');


        Route::post('increaseQuantity', 'PointOfSaleApiController@increaseQuantity');

        Route::post('decreaseQuantity', 'PointOfSaleApiController@decreaseQuantity');

        Route::post('removeItem', 'PointOfSaleApiController@removeItem');

        // save order
        Route::post('saveOrder', 'PointOfSaleApiController@saveOrder');
        Route::post('addItemsToOrder', 'PointOfSaleApiController@addItemsToOrder');

        Route::post('payOrder', 'PointOfSaleApiController@payOrder');

        Route::post('orders', 'PointOfSaleApiController@orders');

         Route::post('orderDetail', 'PointOfSaleApiController@orderDetail');
        Route::post('payRemaining', 'PointOfSaleApiController@payRemaining');


        });

    });


});






