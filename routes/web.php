<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\IklanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuditTrailController;

Route::get('/', [FrontController::class, 'index'])->name('front.index');

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


        Route::group(['prefix' => 'iklan'], function () {
            Route::get('/', [IklanController::class, 'index'])->name('iklan.index');
            Route::get('/create', [IklanController::class, 'create'])->name('iklan.create');
            Route::post('/', [IklanController::class, 'store'])->name('iklan.store');
            Route::post('/ajaxLoadIklan', [IklanController::class, 'ajaxLoadIklan'])->name('iklan.ajaxLoadIklan');
            Route::get('/{uuid}/edit', [IklanController::class, 'edit'])->name('iklan.edit');
            Route::put('/{uuid}', [IklanController::class, 'update'])->name('iklan.update');
            Route::delete('/{uuid}', [IklanController::class, 'destroy'])->name('iklan.destroy');
        });

        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::get('/{uuid}', [UserController::class, 'edit'])->name('users.edit');
            Route::post('/updateimage', [UserController::class, 'updateimage'])->name('users.updateimage');
            Route::post('/updatecover', [UserController::class, 'updatecover'])->name('users.updatecover');
            Route::post('/resetPassword', [UserController::class, 'resetPassword'])->name('users.resetPassword');
            Route::put('/{uuid}', [UserController::class, 'update'])->name('users.update');
            Route::post('/assignrole', [UserController::class, 'assignrole'])->name('users.assignrole');
            Route::delete('/{uuid}', [UserController::class, 'destroy'])->name('users.destroy');
        });

        Route::group(['prefix' => 'audittrail'], function () {
            Route::get('/', [AuditTrailController::class, 'index'])->name('audittrail.index');
            Route::post('/ajaxLoadAuditTrail', [AuditTrailController::class, 'ajaxLoadAuditTrail'])->name('audittrail.ajaxLoadAuditTrail');
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
