<?php

use App\Http\Controllers\Auth\authController;
use App\Http\Controllers\Book\bookController;
use App\Http\Controllers\Book\catalogController;
use App\Http\Controllers\Book\categoryBookController;
use App\Http\Controllers\Checkout\keranjangController;
use App\Http\Controllers\User\userController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Home');
});
// Route::middleware(['auth:','cekLevel:user,admin'])->group(function () {});

Route::get('/login', [authController::class, 'index'])->name('login');
Route::post('/login', [authController::class, 'login_proses']);


Route::middleware(['auth:','cekLevel:user,admin'])->group(function () {


    Route::get('/catalog',[catalogController::class, 'index']);
    Route::post('/catalog',[catalogController::class, 'checkoutKeranjang'])->name('checkout.keranjang');

    Route::get('/keranjang',[keranjangController::class, 'index']);
    Route::post('/keranjang/add',[keranjangController::class, 'addCart'])->name('addCard.checkout');
    Route::post('/keranjang',[keranjangController::class, 'cancelCheckout'])->name('cancel.checkout');

});



Route::middleware(['auth:','cekLevel:user,admin'])->group(function () {

    Route::get('/logout', [authController::class, 'logout']);


    Route::get('/user', [userController::class, 'index']);
    Route::post('/user', [userController::class, 'addData']);
    
    Route::get('/user/data', [userController::class, 'getData'])->name('user.data'); // Route untuk AJAX data
    
    
    Route::get('/add/category', [categoryBookController::class, 'index']);
    Route::post('/add/category', [categoryBookController::class, 'addProcess']);
    
    
    Route::get('/add/book', [bookController::class, 'index']);
    Route::post('/add/book', [bookController::class, 'addProcess']);
    

});
