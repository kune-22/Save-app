<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SavesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\TagController;

Route::get('/', function () {
    return view('welcome');
});


// link listページ
Route::prefix('tag')->group(function (){
    Route::get('/', [TagController::class, 'index'])->name('tag');
    Route::post('/', [TagController::class, 'store'])->name('tag.store');
});

Route::prefix('login')->group(function (){
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/', [LoginController::class, 'store'])->name("login.store");
});

Route::prefix('sign_up')->group(function (){
    Route::get('/', [SignUpController::class, 'index'])->name('sign_up');
    Route::post('/', [SignUpController::class, 'store'])->name("sign_up.store");
});

// topページ
Route::middleware('auth')->group(function (){
    Route::prefix('saves')->group(function (){
        Route::get('/', [SavesController::class, 'index'])->name('saves');
        Route::post('/', [SavesController::class, 'store'])->name('saves.store');
        Route::get('/{id}/edit', [SavesController::class, 'edit'])->name('saves.edit');
        Route::put('/{id}', [SavesController::class, 'update'])->name('saves.update');
    });
});