<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ProjectsTicketsController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TicketsCommentsController;
use App\Http\Controllers\ProjectsUsersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('/projects', ProjectsController::class);

    Route::resource('/tickets', TicketsController::class)->only(['show', 'destroy', 'update']);
    Route::resource('/users', UsersController::class)->only(['create', 'store', 'index', 'show', 'update', 'destroy']);

    Route::post('/projects/{project}/tickets', [ProjectsTicketsController::class, 'store']);
    Route::post('/tickets/{ticket}/comments', [TicketsCommentsController::class, 'store']);

    Route::post('/projects/{project}/users', [ProjectsUsersController::class, 'addUsersToProject']);
    Route::delete('/projects/{project}/users', [ProjectsUsersController::class, 'removeUsersFromProject']);
    Route::post('/projects/{project}/users/subscriptions', [ProjectsUsersController::class, 'subscription']);

    Route::get('/home', [ProjectsController::class, 'index']);
});

Auth::routes(['register' => false]);