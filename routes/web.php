<?php

use App\Http\Controllers\ProcessController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProcessController::class, 'index'])->name('index');
Route::get('/process', [ProcessController::class, 'index'])->name('index');
Route::post('/process', [ProcessController::class, 'process'])->name('process');
