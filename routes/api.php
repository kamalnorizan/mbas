<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController as ApiPostController;
use App\Http\Controllers\Api\IklanController as ApiIklanController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('posts', [ApiPostController::class, 'index']);
    Route::post('posts', [ApiPostController::class, 'store']);
    Route::post('posts/{id}', [ApiPostController::class, 'update']);
    Route::delete('posts/{post}', [ApiPostController::class, 'destroy']);


    //oracle
    Route::get('iklan', [ApiIklanController::class, 'index']);
    Route::get('iklan/{iklan}', [ApiIklanController::class, 'show']);
    Route::post('iklan', [ApiIklanController::class, 'store']);
    Route::post('iklan/{iklan}', [ApiIklanController::class, 'update']);
    Route::delete('iklan/{iklan}', [ApiIklanController::class, 'destroy']);
});
