<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';


Route::middleware('auth')->group(function () {
    Route::get('/{vue_capture?}', [IndexController::class, 'home'])
        ->where('vue_capture', '[\/\w\.-]*')
        ->name('home');

    Route::controller(ProcessController::class)->group(function () {
        Route::get('/process', 'index')->name('process.index');
        Route::post('/process', 'process')
            ->withoutMiddleware(VerifyCsrfToken::class)
            ->name('process');
    });
});

