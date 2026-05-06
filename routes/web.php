<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GovernmentController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ElectricityScheduleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        // Redirect authenticated users to their role-based dashboard
        $role = Auth::user()->role;

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else if ($role === 'farmer') {
            return redirect()->route('farmer.dashboard');
        } else if ($role === 'government') {
            return redirect()->route('government.dashboard');
        }

        return redirect()->route('dashboard');
    }

    // Show welcome page for unauthenticated users
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * Farmer Routes
 */
Route::middleware(['auth', 'verified'])->prefix('farmer')->group(function () {
    Route::get('/dashboard', [FarmerController::class, 'dashboard'])->name('farmer.dashboard');
    Route::get('/apply', [FarmerController::class, 'create'])->name('farmer.apply');
    Route::post('/apply', [FarmerController::class, 'store'])->name('farmer.store');
    Route::get('/schedules', [FarmerController::class, 'index'])->name('farmer.schedules');
    Route::get('/complaints', [ComplaintController::class, 'index'])->name('farmer.complaints');
    Route::get('/complaint/create', [ComplaintController::class, 'create'])->name('farmer.complaint.create');
    Route::post('/complaint', [ComplaintController::class, 'store'])->name('farmer.complaint.store');
    Route::get('/complaint/{id}', [ComplaintController::class, 'show'])->name('farmer.complaint.show');
    Route::get('/complaint/{id}/edit', [ComplaintController::class, 'edit'])->name('farmer.complaint.edit');
    Route::patch('/complaint/{id}', [ComplaintController::class, 'update'])->name('farmer.complaint.update');
    Route::delete('/complaint/{id}', [ComplaintController::class, 'destroy'])->name('farmer.complaint.destroy');
    Route::get('/power-usage', [FarmerController::class, 'usage'])->name('farmer.usage');
    Route::patch('/profile', [FarmerController::class, 'updateProfile'])->name('farmer.profile.update');
});

/**
 * Admin Routes
 */
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Farmers Management
    Route::get('/farmers', [AdminController::class, 'farmers'])->name('admin.farmers');
    Route::patch('/farmer/{id}/approve', [AdminController::class, 'approveFarmer'])->name('admin.farmer.approve');
    Route::patch('/farmer/{id}/reject', [AdminController::class, 'rejectFarmer'])->name('admin.farmer.reject');

    // Electricity Schedules
    Route::get('/schedules', [AdminController::class, 'schedules'])->name('admin.schedules');
    Route::get('/schedule/create', [AdminController::class, 'createSchedule'])->name('admin.schedule.create');
    Route::post('/schedule', [AdminController::class, 'storeSchedule'])->name('admin.schedule.store');
    Route::patch('/schedule/{id}', [AdminController::class, 'updateSchedule'])->name('admin.schedule.update');
    Route::delete('/schedule/{id}', [AdminController::class, 'deleteSchedule'])->name('admin.schedule.delete');

    // Complaints Management
    Route::get('/complaints', [AdminController::class, 'complaints'])->name('admin.complaints');
    Route::patch('/complaint/{id}', [AdminController::class, 'resolveComplaint'])->name('admin.complaint.resolve');

    // Reports
    Route::get('/reports', [AdminController::class, 'reports'])->name('admin.reports');
});

/**
 * Government Routes
 */
Route::middleware(['auth', 'verified', 'admin'])->prefix('government')->group(function () {
    Route::get('/dashboard', [GovernmentController::class, 'dashboard'])->name('government.dashboard');

    // Farmers Information
    Route::get('/farmers', [GovernmentController::class, 'farmers'])->name('government.farmers');

    // Complaints Monitoring
    Route::get('/complaints', [GovernmentController::class, 'complaints'])->name('government.complaints');

    // Power Usage Reports
    Route::get('/power-usage', [GovernmentController::class, 'powerUsage'])->name('government.power-usage');

    // Electricity Schedules
    Route::get('/schedules', [GovernmentController::class, 'schedules'])->name('government.schedules');

    // Reports and Analytics
    Route::get('/reports', [GovernmentController::class, 'reports'])->name('government.reports');
});

/**
 * Public Electricity Schedules
 */
Route::get('/schedules', [ElectricityScheduleController::class, 'index'])->name('schedules.index');
Route::get('/schedule/{id}', [ElectricityScheduleController::class, 'show'])->name('schedules.show');

require __DIR__ . '/auth.php';
