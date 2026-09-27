<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


Route::middleware('admin')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/pengajuan/tambah', [ApplicationController::class, 'create'])
        ->name('applications.create');

    Route::post('/pengajuan', [ApplicationController::class, 'store'])
        ->name('applications.store');

    Route::get('/pengajuan', [ApplicationController::class, 'index'])
        ->name('applications.index');

    Route::get('/pengajuan/{application}', [ApplicationController::class, 'show'])
        ->name('applications.show');

    Route::post('/pengajuan/{application}/approve', [ApplicationController::class, 'approve'])
        ->name('applications.approve');

    Route::post('/pengajuan/{application}/reject', [ApplicationController::class, 'reject'])
        ->name('applications.reject');

    Route::post('/pengajuan/{application}/lunas', [ApplicationController::class, 'lunas'])
        ->name('applications.lunas');

});