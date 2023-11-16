<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/reset-password', [AuthController::class, 'resetPassword'])->name('auth.reset-password');

Route::get('/dashboard', [DashboardController::class, 'dashboardRedirector'])->name('dashboard');