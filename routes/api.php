<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/users', [\App\Http\Controllers\Api\UserController::class, 'all'])->name('api.users');
Route::get('/user/{id}', [\App\Http\Controllers\Api\UserController::class, 'one'])->name('api.user');
Route::post('/user/create', [\App\Http\Controllers\Api\UserController::class, 'create'])->name('api.user.create');
Route::post('/user/update', [\App\Http\Controllers\Api\UserController::class, 'update'])->name('api.user.update');

Route::get('/events', [\App\Http\Controllers\Api\EventController::class, 'all'])->name('api.events');
Route::get('/event/{id}', [\App\Http\Controllers\Api\EventController::class, 'one'])->name('api.event');
Route::post('/event/create', [\App\Http\Controllers\Api\EventController::class, 'create'])->name('api.event.create');
Route::post('/event/update', [\App\Http\Controllers\Api\EventController::class, 'update'])->name('api.event.update');
