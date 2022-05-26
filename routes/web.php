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

use App\Http\Controllers\administartors\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'index']);

Route::group(['prefix'=>'cart'],function(){
    Route::get('/',[CartController::class,'index']);
    Route::post('/add',[CartController::class,'addToCart']);
    Route::match(['get','post'],'/pay',[CartController::class,'payment'])->middleware('user');
});

Route::group(['prefix'=>'user'],function(){
    Route::match(['get','post'],'/login',[UserController::class,'login']);
    Route::match(['get','post'],'/signup',[UserController::class,'signup']);
});

Route::group(['prefix'=>'product'],function(){
    Route::get('/{alias}',[ProductController::class,'view']);
});

Route::match(['get','post'],'administrator/login',[UserController::class,'adminLogin']);

Route::group(['prefix'=>'administrator','middleware'=>'admin'],function(){
    Route::get('/',[DashboardController::class,'index']);

    Route::group(['prefix'=>'product'],function(){
        Route::get('/list',[ProductController::class,'index']);
        Route::post('/delete/{id}',[ProductController::class,'destroy']);
        Route::get('/add',[ProductController::class,'add']);
        Route::post('/store',[ProductController::class,'store']);
        Route::match(['get','post'],'/{id}/edit',[ProductController::class,'add']);
    });

    Route::group(['prefix'=>'order'],function(){
        Route::get('/list',[OrderController::class,'index']);
    });
});
