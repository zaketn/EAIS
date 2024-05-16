<?php

use App\Http\Controllers\Calculator\CalculatorParametersController;
use App\Http\Controllers\CalculatorHistoryController;
use App\Http\Controllers\Rmsp\CompanyTypeController;
use App\Http\Controllers\Rmsp\DistrictController;
use App\Http\Controllers\Rmsp\RegionController;
use App\Http\Controllers\Rmsp\StatisticsController;
use App\Http\Controllers\Rmsp\SupportController;
use App\Http\Controllers\Rmsp\SupportFormController;
use App\Http\Controllers\Rmsp\SupportTypeController;
use App\Http\Controllers\Rmsp\SupportUnitTypeController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UsefulLinksController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('/user', [UserController::class, 'current'])->name('api.user');

    Route::get('/support', [SupportController::class, 'index']);
    Route::get('/support-form', [SupportFormController::class, 'index']);
    Route::get('/support-type', [SupportTypeController::class, 'index']);
    Route::get('/support-unit-type', [SupportUnitTypeController::class, 'index']);
    Route::get('/district', [DistrictController::class, 'index']);
    Route::get('/region', [RegionController::class, 'index']);
    Route::get('/company-type', [CompanyTypeController::class, 'index']);

    Route::get('/users/current', [UserController::class, 'current']);
    Route::resource('/users', UserController::class)->only('index');

    Route::resource('/calculator-parameters', CalculatorParametersController::class);
  
    Route::get('/history/{id}', [CalculatorHistoryController::class, 'getRecord']);
    Route::post('/calculator-history/save-history', [CalculatorHistoryController::class, 'saveData']);
    Route::resource('/calculator-history', CalculatorHistoryController::class);
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
});
