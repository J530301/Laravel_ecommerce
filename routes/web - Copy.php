<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\ProductController;
use App\Http\Livewire\ProductList;
use App\Http\Livewire\ProductDetails;

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Login routes
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');  
Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::post('/check-username', [AuthenticatedSessionController::class, 'checkUsername'])->name('check-username');
Route::post('/reset-password', [AuthenticatedSessionController::class, 'resetPassword'])->name('reset-password');

Route::middleware('guest')->group(function () {
    Route::get('register', [AuthenticatedSessionController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AuthenticatedSessionController::class, 'register']);
});

// Protected routes with 'auth' middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/index', [ProductController::class, 'index'])->name('index');
    Route::post('/buy-product', [ProductController::class, 'buyProduct'])->name('buyProduct');
    Route::get('/order-success', [ProductController::class, 'orderSuccess'])->name('orderSuccess');
    Route::post('/update-stock', [ProductController::class, 'updateStock'])->name('update.stock');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::post('/delete-product', [ProductController::class, 'deleteProduct'])->name('deleteProduct');
    Route::post('/update-image', [ProductController::class, 'updateImage'])->name('update.image');
    Route::post('/update-product', [ProductController::class, 'updateProduct'])->name('updateProduct');
    Route::get('/phone', [ProductController::class, 'showPhones'])->name('phone');
    Route::get('/computer', [ProductController::class, 'showComputers'])->name('computer');
    Route::get('/laptop', [ProductController::class, 'showLaptops'])->name('laptop');
    
});
