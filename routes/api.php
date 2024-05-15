<?php

use App\Http\Controllers\Calculator\CalculatorParametersController;
use App\Http\Controllers\CalculatorHistoryController;
use App\Http\Controllers\Rmsp\StatisticsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UsefulLinksController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', [UserController::class, 'current'])
    ->name('api.user');

Route::resource('tables', TableController::class)->only([
    'index', 'show', 'store'
]);

Route::get('/users/current', [UserController::class, 'current']);
Route::post('/users/update-role', [UserController::class, 'updateRole']);
Route::resource('/users', UserController::class);

Route::resource('/roles', RoleController::class);
Route::resource('/calculator-parameters', CalculatorParametersController::class);

Route::get('/history/{id}', [CalculatorHistoryController::class, 'getRecord']);
Route::get('/history/buisness-calculator/{id}', [CalculatorHistoryController::class, 'getRecord']);
Route::post('/calculator-history/save-history', [CalculatorHistoryController::class, 'saveData']);
Route::resource('/calculator-history', CalculatorHistoryController::class);
Route::resource('/useful-links', UsefulLinksController::class);

Route::controller(StatisticsController::class)->prefix('/statistics')->group(function() {
    Route::post('/by-regions', 'byRegions');
    Route::post('/by-company-type', 'byCompanyType');
    Route::post('/by-support-type', 'bySupportType');
    Route::post('/years', 'getYears');
});
