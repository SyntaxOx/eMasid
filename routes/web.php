<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ResidentController;

// --- AUTH GUEST ROUTES ---
Route::middleware('guest')->group(function () {

    // Login
    Route::get('/', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'loginProcess'])->name('login.process');

    // Registration Steps
    Route::prefix('register')->group(function () {

        // Step 1 — Personal Info
        Route::get('/', [RegisterController::class, 'showStep1'])->name('register');
        Route::post('step1', [RegisterController::class, 'step1'])->name('register.step1');

        // Step 2 — Address Info
        Route::get('address', [RegisterController::class, 'showStep2'])->name('register.address');
        Route::post('step2', [RegisterController::class, 'step2'])->name('register.step2');

        // Step 3 — Account Setup
        Route::get('account', [RegisterController::class, 'showStep3'])->name('register.account');
        Route::post('step3', [RegisterController::class, 'step3'])->name('register.step3');

        // Registration Error Page
        Route::get('error', [RegisterController::class, 'showError'])->name('register.error');
    });

    Route::get('/forgot-password', function () {
        return view('residentUI.auth.forgot_pass');
    })->name('forgot.password');
});

// --- AUTHENTICATED USER ROUTES ---
Route::middleware('auth')->group(function () {

    // Home
    Route::get('/home', [ResidentController::class, 'index'])->name('home');

    Route::get('/profile', function () {
        return view('residentUI.userNav.userProfile');
    })->name('profile');

    Route::get('/report', function () {
        return view('residentUI.userNav.report');
    })->name('report');

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});