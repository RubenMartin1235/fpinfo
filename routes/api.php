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
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('ufs', [FormativeUnitController::class, 'index']);
    Route::get('ufs/{uf}', [FormativeUnitController::class, 'show']);
    Route::get('modules/{module}/ufs', [FormativeUnitController::class, 'showByModul']);
});
Route::group(['middleware' => ['auth:sanctum', 'role:admin']], function () {
    Route::put('ufs/{uf}', [FormativeUnitController::class, 'update']);
    Route::post('ufs', [FormativeUnitController::class, 'store']);
    Route::delete('ufs/{uf}', [FormativeUnitController::class, 'destroy']);
});

// EVALS
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('evaluations', [EvaluationController::class, 'index']);
});
Route::group(['middleware' => ['auth:sanctum', 'role:teacher,admin']], function () {
    Route::get('evaluations/{ev}', [EvaluationController::class, 'show']);
    Route::get('ufs/{uf}/evaluations', [EvaluationController::class, 'showByUF']);
    Route::get('profile/{uf}/evaluations', [EvaluationController::class, 'showByUser']);
});
Route::group(['middleware' => ['auth:sanctum', 'role:admin']], function () {
    Route::get('evaluations/all', [EvaluationController::class, 'showAll']);
    Route::post('evaluations', [EvaluationController::class, 'store']);
    Route::put('evaluations/{ev}', [EvaluationController::class, 'update']);
    Route::delete('evaluations/{ev}', [EvaluationController::class, 'destroy']);
});
