<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register','Api\AuthController@register');
Route::post('login','Api\AuthController@login');


//,'prefix'=>'company'
//Route::group(['namespace'=>'Company'],function (){
//    Config::set('auth.guards.api.provider','companies');
//    Route::group(['namespace'=>'Auth'],function (){
//        Route::post('register','AuthController@register');
//        Route::post('login','AuthController@login');
//
//        Route::post('password/email','ForgotPasswordController@sendResetLinkEmail');
//        Route::post('password/check','ResetPasswordController@checkCode');
//        Route::post('password/reset','ResetPasswordController@reset')->name('company.password.update');
//
//        Route::post('email/resend', 'VerificationController@resend')->name('verification.resend');
//        Route::get('email/verify/{id}/{hash}','VerificationController@verify')->name('verification.verify');
//    });
//});


