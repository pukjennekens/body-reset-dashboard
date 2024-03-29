<?php

use App\Http\Controllers\AdminRecipiesController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminSettingsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebhookController;

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
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::get('/reset-password', [AuthController::class, 'resetPassword'])->name('auth.reset-password');
Route::get('/reset-password/{token}', [AuthController::class, 'resetPasswordToken'])->name('auth.reset-password.token');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::redirect('/registreren', '/register');

// Dashboard routes all with auth middleware, make a group with prefix /dashboard and middleware auth
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'dashboardRedirector'])->name('dashboard');
    Route::get('/home', [DashboardController::class, 'userHome'])->name('dashboard.user.home');
    Route::get('/nutrition-plans', [DashboardController::class, 'userNutritionPlans'])->name('dashboard.user.nutrition-plans');
    Route::get('/nutrition-plans/{id}', [DashboardController::class, 'userNutritionPlan'])->name('dashboard.user.nutrition-plans.show')->where('id', '[0-9]+');
    Route::get('/appointments', [DashboardController::class, 'userAppointments'])->name('dashboard.user.appointments');
    Route::get('/profile', [DashboardController::class, 'userProfile'])->name('dashboard.user.profile');
});

Route::group(['prefix' => 'dashboard/admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [DashboardController::class, 'adminHome'])->name('dashboard.admin.home');

    Route::get('/users', [AdminUserController::class, 'index'])->name('dashboard.admin.users.index');
    Route::get('/users/{id}', [AdminUserController::class, 'show'])->name('dashboard.admin.users.show')->where('id', '[0-9]+');
    Route::get('/users/{id}/anamnesis', [AdminUserController::class, 'anamnesis'])->name('dashboard.admin.users.anamnesis')->where('id', '[0-9]+');
    Route::get('/users/{id}/measurements', [AdminUserController::class, 'measurements'])->name('dashboard.admin.users.measurements')->where('id', '[0-9]+');
    Route::get('/users/{id}/credits', [AdminUserController::class, 'credits'])->name('dashboard.admin.users.credits')->where('id', '[0-9]+');
    Route::get('/users/{id}/nutrition-plans', [AdminUserController::class, 'nutritionPlans'])->name('dashboard.admin.users.nutrition-plans')->where('id', '[0-9]+');
    Route::get('/users/{id}/appointments', [AdminUserController::class, 'appointments'])->name('dashboard.admin.users.appointments')->where('id', '[0-9]+');
    Route::get('/users/{id}/orders', [AdminUserController::class, 'userOrders'])->name('dashboard.admin.users.orders')->where('id', '[0-9]+');

    Route::get('/recipies', [AdminRecipiesController::class, 'index'])->name('dashboard.admin.recipies.index');

    Route::get('/settings/credits', [AdminSettingsController::class, 'credits'])->name('dashboard.admin.settings.credits');
    Route::get('/settings/credit-orders', [AdminUserController::class, 'creditOrders'])->name('dashboard.admin.settings.credit-orders');
    Route::get('/settings/branches', [AdminSettingsController::class, 'branches'])->name('dashboard.admin.settings.branches');
    Route::get('/settings/branches/{id}', [AdminSettingsController::class, 'branch'])->name('dashboard.admin.settings.branches.show')->where('id', '[0-9]+');
    Route::get('/settings/services', [AdminSettingsController::class, 'services'])->name('dashboard.admin.settings.services');
});

Route::get('/', function() {
    return redirect()->route('dashboard');
});

// Mollie webhook route
Route::post('/webhooks/mollie', [WebhookController::class, 'mollie'])->name('webhooks.mollie');

Route::redirect('/inloggen', '/login');