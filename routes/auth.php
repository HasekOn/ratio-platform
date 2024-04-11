<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::post('/register', [AuthController::class, 'store']);

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/login', [AuthController::class, 'authenticate']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/emailVerification/{remember_token}/{user}', [AuthController::class, 'emailVerification'])
    ->name('emailVerification');

Route::get('/resendEmail/{user}', [AuthController::class, 'resendEmail'])
    ->name('resendEmail');
