<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\IklanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuditTrailController;


// DB::listen(function ($event) {
//     dump($event->sql);
// });

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('posts/{uuid}', [FrontController::class, 'postdetail'])->name('front.post.show');
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/ajaxLoadPostChart', [DashboardController::class, 'ajaxLoadPostChart'])->name('dashboard.ajaxLoadPostChart');
    Route::post('/dashboard/ajaxLoadTop5', [DashboardController::class, 'ajaxLoadTop5'])->name('dashboard.ajaxLoadTop5');
    Route::post('/dashboard/ajaxLoadStatusCount', [DashboardController::class, 'ajaxLoadStatusCount'])->name('dashboard.ajaxLoadStatusCount');
    Route::post('/dashboard/ajaxLoadActivityChart', [DashboardController::class, 'ajaxLoadActivityChart'])->name('dashboard.ajaxLoadActivityChart');

    Route::group(['prefix' => 'post'], function () {
        Route::get('/', [PostController::class, 'index'])->name('posts.index');
        Route::post('/ajaxLoadPosts', [PostController::class, 'ajaxLoadPosts'])->name('posts.ajaxLoadPosts');
        Route::get('/create', [PostController::class, 'create'])->name('posts.create');
        Route::get('/{uuid}', [PostController::class, 'show'])->name('posts.show');
        Route::put('/{uuid}', [PostController::class, 'update'])->name('posts.update');
        Route::post('', [PostController::class, 'store'])->name('posts.store');
        Route::get('/{uuid}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::delete('/{uuid}', [PostController::class, 'destroy'])->name('posts.destroy');
    });

    Route::group(['prefix' => 'images'], function () {
        Route::delete('/{id}', [PostController::class, 'destroyimage'])->name('images.destroy');
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
            Route::post('/updaterole', [UserController::class, 'updaterole'])->name('users.updaterole');
            Route::post('/updatepermission', [UserController::class, 'updatepermission'])->name('users.updatepermission');
            Route::post('/resetPassword', [UserController::class, 'resetPassword'])->name('users.resetPassword');
            Route::put('/{uuid}', [UserController::class, 'update'])->name('users.update');
            Route::post('/assignrole', [UserController::class, 'assignrole'])->name('users.assignrole');
            Route::delete('/{uuid}', [UserController::class, 'destroy'])->name('users.destroy');
        });

        Route::group(['prefix' => 'roles'], function () {
            Route::get('/', [RoleController::class, 'index'])->name('roles.index');
            Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
            Route::post('/', [RoleController::class, 'store'])->name('roles.store');
            Route::get('/{uuid}', [RoleController::class, 'edit'])->name('roles.edit');
            Route::put('/{uuid}', [RoleController::class, 'update'])->name('roles.update');
            Route::delete('/{uuid}', [RoleController::class, 'destroy'])->name('roles.destroy');
        });

        Route::group(['prefix' => 'audittrail'], function () {
            Route::get('/', [AuditTrailController::class, 'index'])->name('audittrail.index');
            Route::post('/ajaxLoadAuditTrail', [AuditTrailController::class, 'ajaxLoadAuditTrail'])->name('audittrail.ajaxLoadAuditTrail');
        });

        Route::group(['prefix' => 'backup'], function () {
            Route::get('', [BackupController::class, 'index'])->name('backup.index');
            Route::get('{id}', [BackupController::class, 'download'])->name('backup.download');
            Route::post('/ajaxLoadBackupLog', [BackupController::class, 'ajaxLoadBackupLog'])->name('backup.ajaxLoadBackupLog');
            Route::post('/backuprun', [BackupController::class, 'backuprun'])->name('backup.backuprun');
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
