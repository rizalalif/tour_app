<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'index'])->name('user.dashboard');
Route::get('/package', [UserController::class, 'allPackages'])->name('package.detail');
Route::get('/package/{category:slug}', [UserController::class, 'packageByCategory'])->name('package.category');
Route::get('/package/{package:id}/detail', [UserController::class, 'packageById'])->name('package.detail');
Route::post('/package/checkout', [TransactionController::class, 'checkout'])->name('package.checkout');
Route::get('/package/checkout/{transaction:code}', [TransactionController::class, 'checkoutPage'])->name('package.checkout.page');
Route::post('/package/payment', [TransactionController::class, 'payment'])->name('package.payment');

Route::get('user/login', [AuthController::class, 'loginPage'])->name('login');
Route::get('user/register', [AuthController::class, 'registerPage'])->name('register');
Route::post('user/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('user/register', [AuthController::class, 'createAccount'])->name('auth.register');
