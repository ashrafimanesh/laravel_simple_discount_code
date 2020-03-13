<?php

use App\DataModels\BaseResponse;
use Illuminate\Http\Request;

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

Route::middleware(['auth:api'])->namespace('Api')->group(function(){
    Route::get('coupon','CouponController@index');
    Route::middleware('admin')->prefix('admin')->group(function(){
        Route::prefix('coupon')->group(function(){
            Route::get('/','CouponController@index');
            Route::post('/','CouponController@store');
        });
        Route::prefix('coupon-code')->group(function(){
            Route::post('/','CouponCodeController@store');
            Route::post('assign','CouponCodeController@assign');
        });
    });
});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return response()->json((new BaseResponse())->setData($request->user())->toArray());
//});
