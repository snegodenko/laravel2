<?php

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


Route::get('/', [\App\Http\Controllers\HomeController::class, 'view'])->name('home');

Route::controller(\App\Http\Controllers\EventController::class)->group(function(){
    Route::get('/events', [\App\Http\Controllers\EventController::class, 'view'])->name('event.view');
    Route::any('/event/create', [\App\Http\Controllers\EventController::class, 'create'])->name('event.create');
    Route::any('/event/update/{id}', [\App\Http\Controllers\EventController::class, 'update'])->name('event.update');
    Route::get('/event/delete/{id}', [\App\Http\Controllers\EventController::class, 'delete'])->name('event.delete');
})->name('event');


Route::controller(\App\Http\Controllers\UserController::class)->group(function(){
    Route::any('/user/create', [\App\Http\Controllers\UserController::class, 'create'])->name('user.create');
    Route::get('/users', [\App\Http\Controllers\UserController::class, 'view'])->name('user.view');
    Route::any('/user/update/{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    Route::post('/user/update-password/{id}', [\App\Http\Controllers\UserController::class, 'password'])->name('user.update-password');
    Route::get('/user/delete/{id}', [\App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');
})->name('user');


