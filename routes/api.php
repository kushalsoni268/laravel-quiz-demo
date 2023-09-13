<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\UserController;

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

Route::group(['prefix' => 'v1', 'namespace' => 'api\v1'], function () {    
    Route::post('login', [AuthController::class, 'login']);    
});

Route::group(['middleware' => 'auth:api', 'namespace' => 'api\v1'], function () {
    Route::group(['prefix' => 'v1'], function () {
        Route::post('logout', [AuthController::class, 'logout']);    
        Route::get('questions', [UserController::class, 'questions']);
        Route::post('save-result', [UserController::class, 'saveResult']);
        Route::post('send-result', [UserController::class, 'sendResult']);
    });
});
