<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\Auth\AccountController;
use App\Http\Controllers\HomeController;

// Public routes accessible by all users
Route::get('/', function () {
    return view('index');
});

// Login and registration routes
Route::post('/login', [AccountController::class, 'login'])->name('login');
Route::get('/loginform', [AccountController::class, 'loginform'])->name('login.form');
Route::get('/signup', [AccountController::class, 'signupform'])->name('signup.form');
Route::post('/register/customer', [AccountController::class, 'register'])->name('register.customer');
Route::get('/login', [AccountController::class, 'loginform'])->name('login.form');

// Customer dashboard routes 
Route::middleware(['auth'])->group(function () {
    Route::get('customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('customer/shop', [CustomerController::class, 'shop'])->name('customer.shop');
    Route::get('/customer/details/{id}', [CustomerController::class, 'details'])->name('customer.details');
    Route::get('/customer/details/{id}', [CustomerController::class, 'showProductDetails'])->name('customer.details');
    Route::get('/customer/addToCart/{id}', [CustomerController::class, 'addToCart'])->name('customer.addToCart');
    Route::post('/customer/addToCart/{id}', [CustomerController::class, 'addToCart'])->name('customer.addToCart');
    Route::get('customer/cart', [CustomerController::class, 'cart'])->name('customer.cart');
    Route::put('customer/update-quantity/{key}', [CustomerController::class, 'updateQuantity'])->name('customer.updateQuantity');
    Route::delete('/customer/remove-from-cart/{key}', [CustomerController::class, 'removeFromCart'])->name('customer.removeFromCart');

    Route::get('customer/profile', [AccountController::class, 'showProfile'])->name('customer.profile');
    Route::get('/customer/editprofile', [AccountController::class, 'edit'])->name('customer.editprofile');
    Route::put('/customer/editprofile/update', [AccountController::class, 'update'])->name('customer.editprofile.update');
    


});

Route::post('/logout', [AccountController::class, 'logout'])->name('logout');


// Admin dashboard routes
Route::get('admin/products', [ProductController::class, 'index'])->name('admin.products.index');
Route::get('admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
Route::post('admin/products', [ProductController::class, 'store'])->name('admin.products.store');
Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
Route::put('/admin/products/{product}/update', [ProductController::class, 'update'])->name('admin.products.update');
Route::get('admin/products/{product}/delete', [ProductController::class, 'destroy'])->name('admin.products.delete');

// Supplier routes
Route::get('admin/supplier/index', [SupplierController::class, 'index'])->name('supplier.index');
Route::get('admin/supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
Route::post('admin/supplier/store', [SupplierController::class, 'store'])->name('supplier.store');
Route::get('admin/supplier/update/{id}', [SupplierController::class, 'update'])->name('supplier.update');
Route::put('/admin/supplier/edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit');
Route::get('/admin/supplier/delete/{id}', [SupplierController::class, 'delete'])->name('supplier.delete');

Route::get('/', [HomeController::class, 'index'])->name('home');
