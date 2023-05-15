<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProcessController;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/process', [ProcessController::class, 'index'])->name('index');
Route::post('/process', [ProcessController::class, 'process'])
    ->withoutMiddleware(VerifyCsrfToken::class)
    ->name('process');

Route::get('/', [IndexController::class, 'home']);
