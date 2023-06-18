<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Tables\TableController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/test', fn() => view('test'));

    Route::controller(IndexController::class)->group(function(){
        Route::get('/', 'home')->name('home');
        Route::get('/tables', 'tables')->name('tables');
        Route::get('/statistics', 'statistics')->name('statistics');
    });

    Route::resource('profile', ProfileController::class)->only([
        'edit', 'update', 'destroy'
    ]);

    Route::resource('users', UserController::class);

    Route::controller(ProcessController::class)->group(function () {
        Route::get('/process', 'index')->name('process.index');
        Route::post('/process', 'process')
            ->withoutMiddleware(VerifyCsrfToken::class)
            ->name('process');
    });
});

require __DIR__ . '/auth.php';
