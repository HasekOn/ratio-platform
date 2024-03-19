<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\YourWorkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [YourWorkController::class, 'index'])->name('ratio.home')->middleware('auth');

Route::resource('tasks', TaskController::class)->middleware('auth');
Route::resource('users', UserController::class)->only('show', 'edit', 'update')
    ->middleware('auth');
Route::get('profile', [UserController::class, 'profile'])->name('profile')->middleware('auth');

Route::get('/projects', [ProjectController::class, 'index'])->middleware('auth');
