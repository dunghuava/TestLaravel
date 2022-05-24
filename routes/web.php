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
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'index']);

Route::group(['prefix'=>'cart'],function(){
    Route::get('/',[CartController::class,'index']);
    Route::post('/add',[CartController::class,'addToCart']);
    Route::match(['get','post'],'/pay',[CartController::class,'payment']);
});

Route::group(['prefix'=>'user'],function(){
    Route::match(['get','post'],'/login',[UserController::class,'login']);
});

Route::group(['prefix'=>'product'],function(){
    Route::get('/{alias}',[ProductController::class,'view']);
});

Route::group(['prefix'=>'administrator'],function(){
    Route::get('/',[DashboardController::class,'index']);
    Route::get('/product/list',[ProductController::class,'index']);
    Route::match(['get','post'],'/product/add',[ProductController::class,'add']);
    Route::match(['get','post'],'/product/{id}/edit',[ProductController::class,'add']);
    Route::post('/product/delete',[ProductController::class,'delete']);
});
