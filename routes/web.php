<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/ajaxLoadPostChart', [DashboardController::class, 'ajaxLoadPostChart'])->name('dashboard.ajaxLoadPostChart');
    Route::post('/dashboard/ajaxLoadTop5', [DashboardController::class, 'ajaxLoadTop5'])->name('dashboard.ajaxLoadTop5');

    Route::group(['prefix' => 'post'], function () {
        Route::get('/', [PostController::class, 'index'])->name('posts.index');
        Route::get('/create', [PostController::class, 'create'])->name('posts.create');
        Route::get('/{uuid}', [PostController::class, 'show'])->name('posts.show');
        Route::put('/{uuid}', [PostController::class, 'update'])->name('posts.update');
        Route::post('', [PostController::class, 'store'])->name('posts.store');
        Route::get('/{uuid}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::delete('/{uuid}', [PostController::class, 'destroy'])->name('posts.destroy');
    });

    Route::post('/comment', [CommentController::class, 'store'])->name('comments.store');


    Route::middleware('role:admin')->group(function () {
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::get('/{uuid}', [UserController::class, 'edit'])->name('users.edit');
            Route::post('/assignrole', [UserController::class, 'assignrole'])->name('users.assignrole');
        });
    });



    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('profile.changePassword');
        Route::post('/updateimage', [ProfileController::class, 'updateimage'])->name('profile.updateimage');
        Route::post('/updatecover', [ProfileController::class, 'updatecover'])->name('profile.updatecover');
        Route::delete('', [ProfileController::class, 'deleteAccount'])->name('profile.deleteAccount');
    });

});

Route::post('/register/validate', [RegisterController::class, 'validation'])->name('register.validate');

Auth::routes();
