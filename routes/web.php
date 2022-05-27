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
    Route::get('/',[CartController::class,'index'])->name('cart');
    Route::post('/add',[CartController::class,'addToCart'])->name('cart.add');
    Route::match(['get','post'],'/pay',[CartController::class,'payment'])->middleware('user')->name('cart.pay');
});

Route::group(['prefix'=>'user'],function(){
    Route::match(['get','post'],'/login',[UserController::class,'login'])->name('user.login');
    Route::match(['get','post'],'/signup',[UserController::class,'signup'])->name('user.signup');
});

Route::group(['prefix'=>'product'],function(){
    Route::get('/{alias}',[ProductController::class,'view']);
});

Route::match(['get','post'],'administrator/login',[UserController::class,'adminLogin'])->name('admin.login');

Route::group(['prefix'=>'administrator','middleware'=>'admin'],function(){
    Route::get('/',[DashboardController::class,'index'])->name('admin');

    Route::group(['prefix'=>'product'],function(){
        Route::get('/list',[ProductController::class,'index'])->name('admin.product.list');
        Route::post('/delete/{id}',[ProductController::class,'destroy'])->name('admin.product.delete');
        Route::get('/add',[ProductController::class,'add'])->name('admin.product.add');
        Route::post('/store',[ProductController::class,'store'])->name('admin.product.store');
        Route::get('/{id}/edit',[ProductController::class,'add'])->name('admin.product.delete');
    });

    Route::group(['prefix'=>'order'],function(){
        Route::get('/list',[OrderController::class,'index'])->name('admin.order.list');
    });
});
