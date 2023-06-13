<?php

use App\Http\Controllers\ImportController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\Tables\TableController;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::controller(IndexController::class)->group(function(){
    Route::get('/', 'home');
});

Route::controller(TableController::class)->group(function(){
    Route::post('tables/get-meta', 'meta');
    Route::post('table', 'get');
    Route::post('table/save', 'save');
});

Route::controller(ProcessController::class)->group(function(){
    Route::get('/process', 'index')->name('process.index');
    Route::post('/process', 'process')
        ->withoutMiddleware(VerifyCsrfToken::class)
        ->name('process');
});

Route::controller(StatisticsController::class)->group(function(){
    Route::get('/statistics', 'index')->name('stats.index');
});
