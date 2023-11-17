<?php

use App\Http\Controllers\AdminUserController;
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
Route::get('/reset-password/{token}', [AuthController::class, 'resetPasswordToken'])->name('auth.reset-password.token');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Dashboard routes all with auth middleware, make a group with prefix /dashboard and middleware auth
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'dashboardRedirector'])->name('dashboard');

    Route::get('/measurements', [DashboardController::class, 'userHome'])->name('dashboard.user.home');

    Route::get('/users', [AdminUserController::class, 'index'])->name('dashboard.admin.users.index');
});