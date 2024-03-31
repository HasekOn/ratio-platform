<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTaskController;
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

Route::resource('userProject', UserProjectController::class)->only('show', 'store', 'destroy')
    ->middleware('auth');

Route::post('user/{project}/remove/auth', [UserProjectController::class, 'removeMe'])->name('user.removeMe')
    ->middleware('auth');

Route::post('tasks/{task}/comments', [CommentController::class, 'store'])->name('tasks.comments.store')
    ->middleware('auth');

Route::post('project/{project}/task', [ProjectTaskController::class, 'store'])->name('project.task.store')
    ->middleware('auth');
