<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::resource('tables', TableController::class)->only([
    'index', 'show', 'store'
]);

Route::get('users/current', [UserController::class, 'current']);
Route::post('users/update-role', [UserController::class, 'updateRole']);
Route::resource('users', UserController::class);

Route::resource('roles', RoleController::class);
