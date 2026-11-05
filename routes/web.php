<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Models\Product;

Route::get('/', function () {
    return view('welcome');
});

// Registration Routes
Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register']);

// Login Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Logout Route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    // Fetch all products from the database, newest first
    $products = Product::latest()->get(); 

    // Pass the products to the dashboard view
    return view('dashboard', ['products' => $products]);
})->middleware('auth');

// Forgot Password Routes (Request OTP)
Route::get('/forgot-password', [AuthController::class, 'showForgotForm']);
Route::post('/forgot-password', [AuthController::class, 'sendOtp']);

// Reset Password Routes (Enter OTP & New Password)
Route::get('/reset-password', [AuthController::class, 'showResetForm']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// Shows the page with the product upload form
Route::get('/products/create', [ProductController::class, 'create'])->middleware('auth');

// Handles the actual data and image submission securely
Route::post('/products', [ProductController::class, 'store'])->middleware('auth');

// Cart Routes
Route::post('/cart/add/{product}', [CartController::class, 'add'])->middleware('auth');
Route::get('/cart', [CartController::class, 'index'])->middleware('auth');