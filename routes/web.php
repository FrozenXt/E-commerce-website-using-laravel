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
    CategoryController,
    CartController
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

// --------------------
// Admin Authentication
// --------------------
Route::get('admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'login'])->name('admin.login.submit');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// --------------------
// Admin Routes (Protected)
// --------------------
Route::prefix('admin')->middleware([\App\Http\Middleware\AdminAuth::class])->group(function() {

    // Dashboard & Logout
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');

    // ✅ Admin Services CRUD
    Route::get('services', [ServiceController::class, 'adminIndex'])->name('admin.services.index');
    Route::get('services/create', [ServiceController::class, 'create'])->name('admin.services.create');
    Route::post('services', [ServiceController::class, 'store'])->name('admin.services.store');
    Route::get('services/{id}/edit', [ServiceController::class, 'edit'])->name('admin.services.edit');
    Route::put('services/{id}', [ServiceController::class, 'update'])->name('admin.services.update');
    Route::delete('services/{id}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');

    // ✅ Admin Products CRUD
    Route::get('products', [ProductController::class, 'adminIndex'])->name('admin.products.index');
    Route::get('products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    // ✅ Admin Bookings CRUD
    Route::get('bookings', [BookingController::class, 'adminIndex'])->name('admin.bookings.index');
    Route::get('bookings/create', [BookingController::class, 'createAdmin'])->name('admin.bookings.create');
    Route::post('bookings', [BookingController::class, 'storeAdmin'])->name('admin.bookings.store');
    Route::get('bookings/{id}/edit', [BookingController::class, 'edit'])->name('admin.bookings.edit');
    Route::put('bookings/{id}', [BookingController::class, 'update'])->name('admin.bookings.update');
    Route::delete('bookings/{id}', [BookingController::class, 'destroy'])->name('admin.bookings.destroy');
    Route::get('bookings/{id}', [BookingController::class, 'show'])->name('admin.bookings.show');

    // ✅ Admin Categories CRUD
    Route::get('categories', [CategoryController::class, 'adminIndex'])->name('admin.categories.index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    Route::get('categories/{id}', [CategoryController::class, 'show'])->name('admin.categories.show');


    // ✅ Admin Contacts
    Route::get('contacts', [ContactController::class, 'adminIndex'])->name('admin.contacts.index');
});
