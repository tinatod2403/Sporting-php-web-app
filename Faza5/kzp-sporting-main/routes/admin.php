<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ModeratorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Auth
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login-submit');

Route::group(['middleware' => ['auth.admin']], function () {
    // Auth
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin
    Route::resource('admins', AdminController::class);

    // Moderator
    Route::resource('moderators', ModeratorController::class);

    // Customer
    Route::resource('customers', CustomerController::class);

    // Category
    Route::resource('categories', CategoryController::class);
});
