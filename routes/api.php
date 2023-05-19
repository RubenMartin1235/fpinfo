<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\ModulController;
use App\Http\Controllers\Api\FormativeUnitController;
use App\Http\Controllers\Api\EvaluationController;
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

// USERS
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('profile', [UserController::class, 'profile']);
    Route::put('profile/update', [UserController::class, 'profileUpdate']);
    Route::delete('profile/delete', [UserController::class, 'profileDelete']);
    Route::get('logout', [UserController::class, 'logout']);

    Route::get('profile/{user}', [UserController::class, 'show']);
});
Route::group(['middleware' => ['auth:sanctum', 'role:admin']], function () {
    Route::post('profile', [UserController::class, 'store']);
    Route::put('profile/{user}', [UserController::class, 'update']);
    Route::delete('profile/{user}', [UserController::class, 'destroy']);
});

// MODULES
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('modules', [ModulController::class, 'index']);
    Route::get('modules/{module}', [ModulController::class, 'show']);
});
Route::group(['middleware' => ['auth:sanctum', 'role:admin']], function () {
    Route::put('modules/{module}', [ModulController::class, 'update']);
    Route::post('modules', [ModulController::class, 'store']);
    Route::delete('modules/{module}', [ModulController::class, 'destroy']);
});

// UFS
Route::get('modules/{module}/ufs', [ModulController::class, 'showByModul']);
