<?php

use App\Http\Controllers\ImportController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\Tables\TableController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/test', [TestController::class, 'test'])->name('test');
Route::get('/import', [ImportController::class, 'import'])->name('import');

Route::get('/process', [ProcessController::class, 'index'])->name('index');
Route::post('/process', [ProcessController::class, 'process'])
    ->withoutMiddleware(VerifyCsrfToken::class)
    ->name('process');

Route::get('/', [IndexController::class, 'home']);
Route::get('/table_sald', [IndexController::class, 'table_sald']);
Route::get('/table_number_workers', [IndexController::class, 'table_number_workers']);
Route::get('/table_financial_stability', [IndexController::class, 'table_financial_stability']);
Route::get('/table_main_financial', [IndexController::class, 'table_main_financial']);
Route::get('/stats', [IndexController::class, 'graph_sald']);
Route::get('/graph_number_workers', [IndexController::class, 'graph_number_workers']);
Route::get('/graph_financial_stability', [IndexController::class, 'graph_financial_stability']);
Route::get('/graph_main_financial', [IndexController::class, 'graph_main_financial']);

Route::post('tables/get-meta', [TableController::class, 'meta']);
Route::post('tables/{id}', [TableController::class, 'get']);
Route::post('tables/list/{year}', [TableController::class, 'getTablesList']);
