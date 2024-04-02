<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTaskCommentController;
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

Route::get('profile', [UserController::class, 'profile'])->name('profile')->middleware('auth');

Route::resource('tasks', TaskController::class)->middleware('auth');

Route::resource('users', UserController::class)->only(['show', 'edit', 'update'])->middleware('auth');

Route::resource('projects', ProjectController::class)->middleware('auth');

Route::resource('tasks.comments', CommentController::class)->only(['store'])->middleware('auth');

Route::resource('projectTasks.comments', ProjectTaskCommentController::class)->only(['store'])
    ->middleware('auth');

Route::resource('projects.tasks', ProjectTaskController::class)->only(['store'])->middleware('auth');

Route::resource('projectTasks', ProjectTaskController::class)
    ->except(['store', 'index', 'create'])
    ->middleware('auth');

Route::group(['prefix' => 'projectUser/{project}/', 'as' => 'projectUsers.', 'middleware' => 'auth'], function () {
    Route::get('show', [UserProjectController::class, 'show'])->name('show');
    Route::post('store', [UserProjectController::class, 'store'])->name('store');
    Route::post('remove', [UserProjectController::class, 'destroy'])->name('destroy');
    Route::post('removeMe', [UserProjectController::class, 'removeMe'])->name('removeMe');
});
