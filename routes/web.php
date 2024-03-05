<?php

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

Route::get('/', [YourWorkController::class, 'index'])->name('ratio.home');

Route::get('/projects', [ProjectController::class, 'index']);

Route::get('/create-task', [TaskController::class, 'index']);

Route::get('/show-task/{task}', [TaskController::class, 'show'])->name('tasks.show');

Route::get('/show-task/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');

Route::put('/show-task/{task}', [TaskController::class, 'update'])->name('tasks.update');

Route::post('/create-task', [TaskController::class, 'store'])->name('tasks.created');

Route::delete('/create-task/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
