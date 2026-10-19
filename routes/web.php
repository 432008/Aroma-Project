<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PageController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminReviewController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/about', [HomeController::class, 'about'])
    ->name('about');

/*
|--------------------------------------------------------------------------
| Static Information Pages
|--------------------------------------------------------------------------
*/

Route::get('/page/{slug}', [PageController::class, 'show'])
    ->name('pages.show');

/*
|--------------------------------------------------------------------------
| Perfume Routes
|--------------------------------------------------------------------------
*/

Route::get('/perfumes', [ProductController::class, 'index'])
    ->name('perfumes.index');

Route::get('/perfumes/{slug}', [ProductController::class, 'show'])
    ->name('perfumes.show');

/*
|--------------------------------------------------------------------------
| Collection Routes
|--------------------------------------------------------------------------
*/

Route::get('/collections', [CategoryController::class, 'index'])
    ->name('collections.index');

Route::get('/collections/{slug}', [CategoryController::class, 'show'])
    ->name('collections.show');

/*
|--------------------------------------------------------------------------
| Contact Routes
|--------------------------------------------------------------------------
*/

Route::get('/contact', [ContactController::class, 'index'])
    ->name('contact.index');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');

/*
|--------------------------------------------------------------------------
| Newsletter Route
|--------------------------------------------------------------------------
*/

Route::post('/newsletter', [HomeController::class, 'subscribe'])
    ->name('newsletter.subscribe');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');

    // Password Reset
    Route::get('/forgot-password', [AuthController::class, 'showForgotForm'])
        ->name('password.request');

    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])
        ->name('password.email');

    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])
        ->name('password.reset');

    Route::post('/reset-password', [AuthController::class, 'resetPassword'])
        ->name('password.store');
});

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.index');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.password');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/cart/{product}', [CartController::class, 'add'])
        ->name('cart.add');

    Route::put('/cart/{cart}', [CartController::class, 'update'])
        ->name('cart.update');

    Route::delete('/cart/{cart}', [CartController::class, 'remove'])
        ->name('cart.remove');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::post('/checkout', [CheckoutController::class, 'placeOrder'])
        ->name('checkout.place');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders.index');

    Route::get('/orders/{order}', [OrderController::class, 'show'])
        ->name('orders.show');

    // Submit a perfume review
    Route::post('/perfumes/{product}/reviews', [ReviewController::class, 'store'])
        ->name('reviews.store');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Convenience redirect so /admin lands on the dashboard
Route::redirect('/admin', '/admin/dashboard')
    ->name('admin.home');

Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // Products
        Route::resource('products', AdminProductController::class);

        // Categories
        Route::resource('categories', AdminCategoryController::class);

        // Orders
        Route::get('/orders', [AdminOrderController::class, 'index'])
            ->name('orders.index');

        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])
            ->name('orders.show');

        Route::put('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])
            ->name('orders.status');

        // Users
        Route::get('/users', [AdminUserController::class, 'index'])
            ->name('users.index');

        Route::get('/users/{user}', [AdminUserController::class, 'show'])
            ->name('users.show');

        Route::put('/users/{user}/role', [AdminUserController::class, 'updateRole'])
            ->name('users.role');

        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])
            ->name('users.destroy');

        // Contact Messages
        Route::get('/messages', [AdminContactController::class, 'index'])
            ->name('messages.index');

        Route::get('/messages/{message}', [AdminContactController::class, 'show'])
            ->name('messages.show');

        Route::put('/messages/{message}/read', [AdminContactController::class, 'markAsRead'])
            ->name('messages.read');

        Route::put('/messages/{message}/unread', [AdminContactController::class, 'markAsUnread'])
            ->name('messages.unread');

        Route::delete('/messages/{message}', [AdminContactController::class, 'destroy'])
            ->name('messages.destroy');

        // Review Management
        Route::get('/reviews', [AdminReviewController::class, 'index'])
            ->name('reviews.index');

        Route::patch('/reviews/{review}/approve', [AdminReviewController::class, 'approve'])
            ->name('reviews.approve');

        Route::patch('/reviews/{review}/reject', [AdminReviewController::class, 'reject'])
            ->name('reviews.reject');

        Route::delete('/reviews/{review}', [AdminReviewController::class, 'destroy'])
            ->name('reviews.destroy');
    });