<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\AccountController;

Route::get('/', function () {
    return view('welcome');
});



//admin dashboard
Route::get('admin/products', [ProductController::class, 'index'])->name('admin.products.index');
Route::get('admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
Route::post('admin/products', [ProductController::class, 'store'])->name('admin.products.store');
Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
Route::put('/admin/products/{product}/update', [ProductController::class, 'update'])->name('admin.products.update');
Route::get('admin/products/{product}/delete', [ProductController::class, 'destroy'])->name('admin.products.delete');

//user dashboard
// Route::get('user', [CustomerController::class, 'index'])->name('user.index');
// Route::get('user/cart', [CustomerController::class, 'cart'])->name('user.cart');
// Route::get('/user/add-to-cart/{id}', [CustomerController::class, 'addToCart'])->name('user.addToCart');
// Route::delete('/user/remove-from-cart/{key}', [CustomerController::class, 'removeFromCart'])->name('user.removeFromCart');
// Route::put('user/update-quantity/{key}', [CustomerController::class, 'updateQuantity'])->name('user.updateQuantity');
// Route::get('/user/product/{id}', [CustomerController::class, 'viewProduct'])->name('user.product');
// Route::post('/user/add-to-cart/{id}', [CustomerController::class, 'addToCart'])->name('user.addToCart');
// Route::get('user/search-query', [CustomerController::class, 'search'])->name('user.search-query');

Route::get('customer', [CustomerController::class, 'index'])->name('customer.index');
Route::get('customer/shop', [CustomerController::class, 'shop'])->name('customer.shop');
Route::get('/customer/details/{id}', [CustomerController::class, 'details'])->name('customer.details');
Route::get('/customer/details/{id}', [CustomerController::class, 'showProductDetails'])->name('customer.details');
Route::get('/customer/addToCart/{id}', [CustomerController::class, 'addToCart'])->name('customer.addToCart');
Route::post('/customer/addToCart/{id}', [CustomerController::class, 'addToCart'])->name('customer.addToCart');
Route::get('customer/cart', [CustomerController::class, 'cart'])->name('customer.cart');
Route::put('customer/update-quantity/{key}', [CustomerController::class, 'updateQuantity'])->name('customer.updateQuantity');
Route::delete('/customer/remove-from-cart/{key}', [CustomerController::class, 'removeFromCart'])->name('customer.removeFromCart');

//
Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
});

//login routes
Route::post('/login', [AccountController::class, 'login'])->name('login');
Route::get('/loginform', [AccountController::class, 'loginform'])->name('login.form');
Route::get('/signup', [AccountController::class, 'signupform'])->name('signup.form');
Route::post('/register/customer', [AccountController::class, 'register'])->name('register.customer');
Route::get('/login', [AccountController::class, 'loginform'])->name('login.form');
