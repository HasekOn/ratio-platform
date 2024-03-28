<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProjectController;
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

Route::resource('projects', ProjectController::class)->middleware('auth');

Route::post('user/{project}/add', [UserProjectController::class, 'add'])->name('user.add')->middleware('auth');

Route::post('user/{project}/remove', [UserProjectController::class, 'remove'])->name('user.remove')->middleware('auth');

Route::get('user/{project}/show', [UserProjectController::class, 'show'])->name('user.show')->middleware('auth');

Route::post('user/{project}/remove/auth', [UserProjectController::class, 'removeMe'])->name('user.removeMe')->middleware('auth');
