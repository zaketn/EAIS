<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProcessController;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/{vue_capture?}', IndexController::class)
    ->where('vue_capture', '[\/\w\.-]*');

Route::middleware('auth')->group(function () {
    Route::controller(ProcessController::class)->group(function () {
        Route::get('/process', 'index')->name('process.index');
        Route::post('/process', 'process')
            ->withoutMiddleware(VerifyCsrfToken::class)
            ->name('process');
    });
});

require __DIR__ . '/auth.php';
