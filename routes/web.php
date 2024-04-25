<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\InvitationController;
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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [YourWorkController::class, 'index'])->name('ratio.home');
    Route::get('/task/{status}', [YourWorkController::class, 'getTaskByStatus'])->name('status');
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::get('profile/{user}', [UserController::class, 'userProfile'])->name('userProfile');
    Route::get('/search/{project}', [ProjectController::class, 'search'])->name('search');
    Route::get('/project/{project}/{status}', [ProjectController::class, 'getTaskByStatus'])->name('projectTaskStatus');
    Route::get('/tasks/{task}/preview', [TaskController::class, 'showTaskPreview'])->name('taskPreview');
    Route::get('/projects/{projectTask}/preview', [ProjectController::class, 'projectTaskPreview'])->name('projectTaskPreview');
    Route::get('profilePhoto/{user}', [UserController::class, 'removeProfilePhoto'])->name('removeProfilePhoto');
    Route::resource('tasks', TaskController::class);
    Route::resource('users', UserController::class)->only(['show', 'edit', 'update']);
    Route::resource('projects', ProjectController::class);
    Route::resource('tasks.comments', CommentController::class)->only(['store', 'destroy']);
    Route::resource('projectTasks.comments', ProjectTaskCommentController::class)->only(['store', 'destroy']);
    Route::resource('projects.tasks', ProjectTaskController::class)->only(['store']);
    Route::resource('projectTasks', ProjectTaskController::class)->except(['store', 'index', 'create']);
});

Route::group(['prefix' => 'projectUser/{project}/', 'as' => 'projectUsers.', 'middleware' => 'auth'], function () {
    Route::get('show', [UserProjectController::class, 'show'])->name('show');
    Route::post('store', [UserProjectController::class, 'store'])->name('store');
    Route::post('remove', [UserProjectController::class, 'destroy'])->name('destroy');
    Route::post('removeMe', [UserProjectController::class, 'removeMe'])->name('removeMe');
});

Route::get('/acceptInvitation/{remember_token}/{invitation}/{project}', [InvitationController::class, 'attachMemberToProject'])
    ->name('attachMemberToProject')->middleware('auth');
