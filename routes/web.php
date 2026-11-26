<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SaleController;

Route::redirect('/', '/products');

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::middleware('auth')->group(function () {

    Route::resource('products', ProductController::class);

    Route::resource('customers', CustomerController::class);

    Route::resource('users', UserController::class);

    Route::resource('sales', SaleController::class)
        ->only([
            'index',
            'create',
            'store'
        ]);
});
