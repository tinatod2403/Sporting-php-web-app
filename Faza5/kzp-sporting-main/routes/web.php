<?php

use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [WebController::class, 'index'])->name('home');
Route::get('/register', [WebController::class, 'registerPage'])->name('register-page');
Route::post('/register', [WebController::class, 'register'])->name('register');
Route::get('/news/news/{news}', [WebController::class, 'news'])->name('news');
Route::get('/about-us', [WebController::class, 'aboutUs'])->name('about-us');
Route::get('/category/{category}', [WebController::class, 'category'])->name('category');
Route::get('/category/{category}/complex/{complex}', [WebController::class, 'complex'])->name('complex');
Route::get('/category/{category}/complex/{complex}/calendar', [WebController::class, 'calendar'])->name('calendar');
Route::post('/login', [WebController::class, 'login'])->name('login');
Route::get('/logout', [WebController::class, 'logout'])->name('logout');
Route::get('/my-profile', [WebController::class, 'myProfile'])->name('my-profile');
Route::post('/add-rate', [WebController::class, 'addRate'])->name('add-rate');
Route::get('/get-free-appointments', [WebController::class, 'getFreeAppointments'])->name('get-free-appointments');
Route::get('/reservation-appointments', [WebController::class, 'reservationAppointments'])->name('reservation-appointments');
