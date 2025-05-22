<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/home', [AuthController::class, 'home'])->middleware('auth')->name('home');
Route::get('/galeri', [AuthController::class, 'galeri'])->middleware('auth')->name('galeri');
Route::get('/tentang', [AuthController::class, 'tentang'])->middleware('auth')->name('tentang');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Rute untuk ArticlesController
Route::prefix('articles')->group(function () {
    Route::get('/', [ArticlesController::class, 'index'])->middleware('auth')->name('articles.index');
    Route::get('/create', [ArticlesController::class, 'create'])->middleware('auth')->name('articles.create');
    Route::post('/', [ArticlesController::class, 'store'])->middleware('auth')->name('articles.store');
    Route::get('/{id}', [ArticlesController::class, 'show'])->middleware('auth')->name('articles.show');
    Route::get('/{id}/edit', [ArticlesController::class, 'edit'])->middleware('auth')->name('articles.edit');
    Route::put('/{id}', [ArticlesController::class, 'update'])->middleware('auth')->name('articles.update');
    Route::delete('/{id}', [ArticlesController::class, 'destroy'])->middleware('auth')->name('articles.destroy');
});

// Rute untuk UserController
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->middleware('auth')->name('users.index');
    Route::get('/create', [UserController::class, 'create'])->middleware('auth')->name('users.create');
    Route::post('/', [UserController::class, 'store'])->middleware('auth')->name('users.store');
    Route::get('/{id}', [UserController::class, 'show'])->middleware('auth')->name('users.show');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->middleware('auth')->name('users.edit');
    Route::put('/{id}', [UserController::class, 'update'])->middleware('auth')->name('users.update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->middleware('auth')->name('users.destroy');
});