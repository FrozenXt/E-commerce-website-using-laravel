<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    ProductController,
    ServiceController,
    BookingController,
    ContactController,
    AboutController,
    AdminController,
    CategoryController
};

// --------------------
// Public Routes
// --------------------
Route::get('/', [HomeController::class, 'index'])->name('home');

// Products / Shop
Route::get('/shop', [ProductController::class, 'index'])->name('products.index');
Route::get('/shop/{slug}', [ProductController::class, 'show'])->name('products.show');

// Services
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');

// Bookings
Route::get('/book-repair', [BookingController::class, 'create'])->name('booking.create');
Route::post('/book-repair', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking-success/{id}', [BookingController::class, 'success'])->name('booking.success');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// About
Route::get('/about', [AboutController::class, 'index'])->name('about');


Route::get('admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'login'])->name('admin.login.submit');

Route::prefix('admin')->middleware([\App\Http\Middleware\AdminAuth::class])->group(function() {

    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');

    // ✅ Admin Service CRUD with proper names
    Route::get('services', [ServiceController::class, 'adminIndex'])->name('admin.services.index');
    Route::get('services/create', [ServiceController::class, 'create'])->name('admin.services.create');
    Route::post('services', [ServiceController::class, 'store'])->name('admin.services.store');
    Route::get('services/{id}/edit', [ServiceController::class, 'edit'])->name('admin.services.edit');
    Route::put('services/{id}', [ServiceController::class, 'update'])->name('admin.services.update');
    Route::delete('services/{id}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');

    // ✅ Admin Product list page
     Route::get('products', [ProductController::class, 'adminIndex'])->name('admin.products.index');
     Route::get('products/create', [ProductController::class, 'create'])->name('admin.products.create');
     Route::post('products', [ProductController::class, 'store'])->name('admin.products.store');
     Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
     Route::put('products/{id}', [ProductController::class, 'update'])->name('admin.products.update');
     Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    // Admin Bookings CRUD
    Route::get('bookings', [BookingController::class, 'adminIndex'])->name('admin.bookings.index');
    Route::get('bookings/create', [BookingController::class, 'createAdmin'])->name('admin.bookings.create');
    Route::post('bookings', [BookingController::class, 'storeAdmin'])->name('admin.bookings.store');
    Route::get('bookings/{id}/edit', [BookingController::class, 'edit'])->name('admin.bookings.edit');
    Route::put('bookings/{id}', [BookingController::class, 'update'])->name('admin.bookings.update');
    Route::delete('bookings/{id}', [BookingController::class, 'destroy'])->name('admin.bookings.destroy');
    Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('admin.bookings.show');


    Route::get('categories', [CategoryController::class, 'adminIndex'])->name('admin.categories.index');
    Route::get('contacts', [ContactController::class, 'adminIndex'])->name('admin.contacts.index');


});