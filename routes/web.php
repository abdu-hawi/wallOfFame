<?php

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

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'maintenance'],function (){
    Route::get('/', function () {
        return view('welcome');
    });

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');
});

Route::get('maintenance',function (){
   return view('frontend.maintenance');
});
Route::get("storage",function (){
   Artisan::call('storage:link');
    dd('done');
});


Route::group(['prefix' => 'command'], function () {
    Route::get('/migrate', function () {
        Artisan::call('migrate');
        dd('done');
    });

    Route::get('/seed', function () {
        Artisan::call('db:seed');
        dd('done');
    });
    Route::get('/storage', function () {
        Artisan::call('storage:link');
//        exec('ln -s /domains/a056056.xyz/storage /domains/a056056.xyz/public_html/storage');
        dd('done');
    });
    Route::get('/clear', function () {
        Artisan::call('config:clear');
        Artisan::call('optimize:clear');
        echo "done";
    });
    Route::get('/passport', function () {
        Artisan::call('passport:install');
    });
});




