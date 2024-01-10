<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\WorkLogController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use Illuminate\Support\Facades\Route;

Route::get('login', function () {
    return redirect(route('login'));
});

Route::get('register', function () {
    return redirect(route('login'));
});

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('projects')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('project.index');
        Route::get('/create', [ProjectController::class, 'create'])->name('project.create');
        Route::post('/create', [ProjectController::class, 'store']);
        Route::get('/{projectRef}/edit', [ProjectController::class, 'edit'])->name('project.edit');
        Route::put('/{projectRef}/edit', [ProjectController::class, 'update']);
        Route::delete('/{projectRef}', [ProjectController::class, 'destroy'])->name('project.delete');
    });

    Route::prefix('work-logs')->group(function () {
        Route::get('/', [WorkLogController::class, 'index'])->name('work-log.index');
        Route::get('/show/{workLogRef}', [WorkLogController::class, 'show'])->name('work-log.show');
        Route::get('/create', [WorkLogController::class, 'create'])->name('work-log.create');
        Route::post('/create', [WorkLogController::class, 'store']);
        Route::get('/{workLogRef}/edit', [WorkLogController::class, 'edit'])->name('work-log.edit');
        Route::put('/{workLogRef}/edit', [WorkLogController::class, 'update']);
        Route::delete('/{workLogRef}', [WorkLogController::class, 'destroy'])->name('work-log.delete');
    });

    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('settings.index');
        Route::get('/create', [SettingsController::class, 'create'])->name('settings.create');
        Route::post('/create', [SettingsController::class, 'store']);
        Route::get('/{settingId}/edit', [SettingsController::class, 'edit'])->name('settings.edit');
        Route::put('/{settingId}/edit', [SettingsController::class, 'update']);
        Route::delete('/{settingId}', [SettingsController::class, 'destroy'])->name('settings.delete');
    });

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
