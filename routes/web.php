<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/ajaxLoadPostChart', [DashboardController::class, 'ajaxLoadPostChart'])->name('dashboard.ajaxLoadPostChart');
    Route::post('/dashboard/ajaxLoadTop5', [DashboardController::class, 'ajaxLoadTop5'])->name('dashboard.ajaxLoadTop5');

    Route::get('/post', [PostController::class, 'index'])->name('posts.index');
    Route::get('/post/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/post', [PostController::class, 'store'])->name('posts.store');
    Route::get('/post-delete/{id}',[PostController::class, 'delete']);
    Route::get('/post-edit/{id}',[PostController::class, 'edit']);
    Route::get('/post-report',[PostController::class, 'report']);
    Route::get('/post-dashboard',[PostController::class, 'dashboard']);
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
