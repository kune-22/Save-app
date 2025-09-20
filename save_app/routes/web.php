<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SavesController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [SavesController::class, 'index'])->name('home');