<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\HomeController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\RoleHasPermissionController;
use App\Http\Controllers\backend\UserController;
use Illuminate\Support\Facades\Route;


// Authentication Routes
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login_store'])->name('login_store');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Backend Routes with Middleware
Route::prefix('backend')->middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('backend.dashboard');

    // Manage Reports
    Route::get('/manage-report', [HomeController::class, 'index'])->name('manage-report');

    // Role Management (Restricted to Admin Role)
    Route::resource('roles', RoleController::class)->middleware('role_permission:Admin');

    // User Management (Restricted to Admin Role)
    Route::resource('users', UserController::class);

    // Profile Management
    Route::get('profile', [UserController::class, 'profile'])->name('users.profile');

    // Edit User Profile
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');

    // Role Has Permissions
    Route::get('role-has-permissions', [RoleHasPermissionController::class, 'index'])->name('role-has-permissions');

    // Roles with Permissions Update (Restricted to Authenticated Users)
    Route::prefix('roles')->group(function () {
        Route::post('permissions', [RoleHasPermissionController::class, 'update'])->name('roles.permissions.update');
    });
});
