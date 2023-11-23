<?php

use App\Http\Controllers\AdminRecipiesController;
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
    Route::get('/home', [DashboardController::class, 'userHome'])->name('dashboard.user.home');
    Route::get('/measurements', [DashboardController::class, 'userHome'])->name('dashboard.user.measurements');

    Route::get('/users', [AdminUserController::class, 'index'])->name('dashboard.admin.users.index');
    Route::get('/users/{id}', [AdminUserController::class, 'show'])->name('dashboard.admin.users.show')->where('id', '[0-9]+');
    Route::get('/users/{id}/measurements', [AdminUserController::class, 'measurements'])->name('dashboard.admin.users.measurements')->where('id', '[0-9]+');
    Route::get('/users/{id}/credits', [AdminUserController::class, 'credits'])->name('dashboard.admin.users.credits')->where('id', '[0-9]+');

    Route::get('/recipies', [AdminRecipiesController::class, 'index'])->name('dashboard.admin.recipies.index');
});