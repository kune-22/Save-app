<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SavesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignUpController;

Route::get('/', function () {
    return view('welcome');
});

// topページ
Route::prefix('saves')->group(function (){
    Route::get('/', [SavesController::class, 'index'])->name('home');
    Route::post('/', [SavesController::class, 'store'])->name('saves.store');
});

// link listページ
Route::prefix('links')->group(function (){
    Route::get('/', [SavesController::class, 'list'])->name('list');
});

Route::prefix('login')->group(function (){
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/', [SignUpController::class, 'store'])->name("login.store");
});

Route::prefix('sign_up')->group(function (){
    Route::get('/', [SignUpController::class, 'index'])->name('sign_up');
    Route::post('/', [SignUpController::class, 'store'])->name("sign_up.store");
});