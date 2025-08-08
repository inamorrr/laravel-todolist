<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Halaman awal publik
Route::get('/', function () {
    return view('welcome');
});

// Autentikasi
Auth::routes();

// Setelah login, user diarahkan ke /home
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

// Resource tasks hanya untuk user login
Route::middleware('auth')->group(function () {
    Route::resource('tasks', TaskController::class);
});

