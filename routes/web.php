<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
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

Route::get('/projects', [ProjectController::class, 'index'])->middleware('auth');

Route::get('/create-task', [TaskController::class, 'index'])->middleware('auth');

Route::get('/show-task/{task}', [TaskController::class, 'show'])->name('tasks.show')->middleware('auth');

Route::get('/show-task/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit')->middleware('auth');

Route::put('/show-task/{task}', [TaskController::class, 'update'])->name('tasks.update')->middleware('auth');

Route::post('/create-task', [TaskController::class, 'store'])->name('tasks.created')->middleware('auth');

Route::delete('/create-task/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy')->middleware('auth');

Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::post('/register', [AuthController::class, 'store']);

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/login', [AuthController::class, 'authenticate']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

