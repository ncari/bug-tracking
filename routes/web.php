<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ProjectsTicketsController;
use App\Http\Controllers\TicketsController;

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

Route::resource('/projects', ProjectsController::class);
Route::resource('/tickets', TicketsController::class)->only(['show', 'destroy']);

Route::post('/projects/{project}/tickets', [ProjectsTicketsController::class, 'store']);
