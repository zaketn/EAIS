<?php

use App\Http\Controllers\Calculator\CalculatorParametersController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('tables', TableController::class)->only([
    'index', 'show', 'store'
]);

Route::get('/users/current', [UserController::class, 'current']);
Route::post('/users/update-role', [UserController::class, 'updateRole']);
Route::resource('/users', UserController::class);

Route::resource('/roles', RoleController::class);
Route::resource('/calculator-parameters', CalculatorParametersController::class);
