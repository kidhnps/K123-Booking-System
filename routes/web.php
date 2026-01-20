<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;

// Public Routes
Route::get('/', [BookingController::class, 'home'])->name('home');
Route::get('booking/search', [BookingController::class, 'search'])->name('booking.search');

// Auth Routes
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Captcha
Route::get('captcha/flat', [Mews\Captcha\Captcha::class, 'create'])->name('captcha');

// Member Routes (Protected)
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [BookingController::class, 'index'])->name('dashboard');
    Route::post('booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('booking/success/{booking}', [BookingController::class, 'success'])->name('booking.success');
    Route::delete('booking/{booking}', [BookingController::class, 'destroy'])->name('booking.destroy');
    
    // Legacy route redirect or use if needed
    Route::get('booking/create', function() {
        return redirect()->route('home');
    })->name('booking.create');
});

// Admin Routes
Route::middleware(['auth', 'can:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('status', [AdminController::class, 'status'])->name('status');
    
    Route::get('users', [AdminController::class, 'users'])->name('users');
    Route::get('users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('users/{user}', [AdminController::class, 'updateUser'])->name('users.update');

    Route::get('bookings/{booking}/edit', [AdminController::class, 'editBooking'])->name('bookings.edit');
    Route::put('bookings/{booking}', [AdminController::class, 'updateBooking'])->name('bookings.update');
    Route::delete('bookings/{booking}', [AdminController::class, 'destroyBooking'])->name('bookings.destroy');

    Route::get('settings', [AdminController::class, 'settings'])->name('settings');
    Route::put('settings', [AdminController::class, 'updateSettings'])->name('settings.update');
});
