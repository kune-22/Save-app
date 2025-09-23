<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SavesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ListController;

Route::get('/', function () {
    return view('welcome');
});




Route::prefix('login')->group(function (){
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/', [LoginController::class, 'store'])->name("login.store");
});

Route::prefix('sign_up')->group(function (){
    Route::get('/', [SignUpController::class, 'index'])->name('sign_up');
    Route::post('/', [SignUpController::class, 'store'])->name("sign_up.store");
});

Route::middleware('auth')->group(function (){
    // topページ
    Route::prefix('saves')->group(function (){
        Route::get('/', [SavesController::class, 'home'])->name('saves.top');
        Route::get('/show/{id}', [SavesController::class, 'show'])->name('saves.show');
    });
    // リンク管理ページ
    Route::prefix('link')->group(function (){
        Route::get('/', [SavesController::class, 'index'])->name('link');
        
        Route::get('/{id}/edit', [SavesController::class, 'edit'])->name('link.edit');
        Route::put('/{id}', [SavesController::class, 'update'])->name('link.update');
        
        Route::post('/', [SavesController::class, 'store'])->name('link.store');
        Route::delete('/{id}', [SavesController::class, 'destroy'])->name('link.destroy');
    });
    // tagの管理ページ
    Route::prefix('tag')->group(function (){
        Route::get('/', [TagController::class, 'index'])->name('tag');
        Route::post('/', [TagController::class, 'store'])->name('tag.store');

        Route::get('/{id}/edit', [TagController::class, 'edit'])->name('tag.edit');
        Route::put('/{id}', [TagController::class, 'update'])->name('tag.update');

        Route::delete('/{id}', [TagController::class, 'destroy'])->name('tag.destroy');
    });
    // 一覧ページ
    Route::prefix('list')->group(function (){
        Route::get('/', [ListController::class, 'index'])->name('list');
    });
});