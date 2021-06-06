<?php

use App\Http\Controllers\Moderator\AuthController;
use App\Http\Controllers\Moderator\ComplexController;
use App\Http\Controllers\Moderator\CourtController;
use App\Http\Controllers\Moderator\DashboardController;
use App\Http\Controllers\Moderator\NewsController;
use App\Http\Controllers\Moderator\ReservationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Moderator Routes
|--------------------------------------------------------------------------
*/

// Auth
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login-submit');

Route::group(['middleware' => ['auth.moderator']], function () {
    // Auth
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Complex
    Route::get('complexes/{complex}/edit', [ComplexController::class, 'edit'])->name('complexes.edit');
    Route::patch('complexes/{complex}', [ComplexController::class, 'update'])->name('complexes.update');

    // Reservation
    Route::get('reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('reservations/{reservation}/update', [ReservationController::class, 'update'])->name('reservations.update');

    // Court
    Route::get('courts', [CourtController::class, 'index'])->name('courts.index');

    // News
    Route::resource('news', NewsController::class);
});
