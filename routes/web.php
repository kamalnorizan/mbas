<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['pakguard'])->group(function() {
    Route::get('/post-list',
    [PostController::class, 'listing']);

    Route::get('/post-create',
    [PostController::class, 'create']);

    Route::post('/post-save',
    [PostController::class, 'save']);

    // mbas-lara2.test/post-delete/10
    Route::get('/post-delete/{id}',
    [PostController::class, 'delete']);

    // mbas-lara2.test/post-edit/10
    Route::get('/post-edit/{id}',
    [PostController::class, 'edit']);

    Route::get('/post-report',
    [PostController::class, 'report']);

    Route::get('/post-dashboard',
    [PostController::class, 'dashboard']);
});

Route::get('/login',
[LoginController::class, 'login']);

Route::post('/auth',
[LoginController::class, 'auth']);

Route::get('/logout',
[LoginController::class, 'logout']);

Route::get("/test-ora", function() {
    $rows = DB::connection('oracle')->table('A')->get();
    dd($rows);
});
