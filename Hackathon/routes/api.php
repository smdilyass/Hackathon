<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});

Route::middleware(['jwt.auth', 'checkRole:admin'])->group(function () {
    // Routes réservées aux admins
    Route::get('/admin/dashboard', 'AdminController@dashboard');
});

Route::middleware(['jwt.auth', 'checkRole:jury,admin'])->group(function () {
    // Routes réservées aux jurys et admins
    Route::get('/jury/results', 'JuryController@results');
});

Route::middleware(['jwt.auth'])->group(function () {
    // Routes pour les participants (et autres rôles)
    Route::get('/participant/profile', 'ParticipantController@profile');
});

Route::controller(TodoController::class)->group(function () {
    Route::get('todos', 'index');
    Route::post('todo', 'store');
    Route::get('todo/{id}', 'show');
    Route::put('todo/{id}', 'update');
    Route::delete('todo/{id}', 'destroy');
}); 