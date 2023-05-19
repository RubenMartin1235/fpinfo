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

    Route::get('users/{user}', [UserController::class, 'show']);
});
