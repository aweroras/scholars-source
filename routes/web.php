<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AccountController;
use App\Http\Controllers\SuppliertransactionController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\RoleMiddleware;
use App\Mail\Verification;
use Illuminate\Support\Facades\Mail;


// Public routes accessible by all users
// Route::get('/', function () {
//     return view('index');
// });

// Login and registration routes
Route::post('/login', [AccountController::class, 'login'])->name('login');

Route::get('/signup', [AccountController::class, 'signupform'])->name('signup.form');
Route::get('/signup/admin', [AccountController::class, 'AdminSignupForm'])->name('signup.admin');

Route::post('/register/customer', [AccountController::class, 'register'])->name('register.customer');
Route::post('/register/admin', [AccountController::class, 'registerAdmin'])->name('register.admin');
Route::get('/login', [AccountController::class, 'loginform'])->name('login.form');

Route::get('/account/verify/{email}', [AccountController::class, 'verify'])->name('account.verify');


// Customer dashboard routes 
Route::middleware(['auth'])->group(function () {
Route::get('customer', [CustomerController::class, 'index'])->name('customer.index');
Route::get('customer/shop', [CustomerController::class, 'shop'])->name('customer.shop');
Route::get('/customer/details/{id}', [CustomerController::class, 'details'])->name('customer.details');
Route::get('/customer/details/{id}', [CustomerController::class, 'showProductDetails'])->name('customer.details');
//Route::get('/customer/addToCart/{id}', [CustomerController::class, 'addToCartSingle'])->name('customer.addToCartSingle');
Route::post('/customer/addToCart/{id}', [CustomerController::class, 'addToCart'])->name('customer.addToCart');
Route::get('customer/cart', [CustomerController::class, 'cart'])->name('customer.cart');
Route::put('customer/update-quantity/{customer_id}/{product_id}', [CustomerController::class, 'updateQuantity'])->name('customer.updateQuantity');
Route::delete('/customer/remove-from-cart/{product_id}', [CustomerController::class, 'removeFromCart'])->name('customer.removeFromCart');
Route::get('customer/checkout',[CustomerController::class,'checkout'])->name('customer.checkout');
Route::get('customer/orderinfo',[CustomerController::class,'orderinfo'])->name('customer.orderinfo');
Route::post('customer/placeorder',[CustomerController::class,'placeorder'])->name('customer.placeorder');


// Edit and update account info (profile pic, name, address, phonenum, and email)
Route::get('customer/profile', [AccountController::class, 'showProfile'])->name('customer.profile');
Route::get('/customer/editprofile', [AccountController::class, 'edit'])->name('customer.editprofile');
Route::put('/customer/editprofile/update', [AccountController::class, 'update'])->name('customer.editprofile.update');
    
// Change user password
Route::get('/changepass', [AccountController::class, 'showChangePasswordForm'])->name('change.password.form');
Route::post('/changepass', [AccountController::class, 'changePassword'])->name('change.password');
});

Route::get('customer/search', [CustomerController::class, 'search'])->name('customer.search');
Route::post('/logout', [AccountController::class, 'logout'])->name('logout');



// Admin dashboard (yung admin lang makakaaccess ng routes)
Route::middleware(['auth', 'role:admin'])->group(function () {
Route::get('admin/products', [ProductController::class, 'index'])->name('admin.products.index');
Route::get('admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
Route::post('admin/products', [ProductController::class, 'store'])->name('admin.products.store');
Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
Route::put('/admin/products/{product}/update', [ProductController::class, 'update'])->name('admin.products.update');
Route::get('admin/products/{product}/delete', [ProductController::class, 'destroy'])->name('admin.products.delete');
Route::post('admin/products/restore-all', [ProductController::class, 'restoreAll'])->name('admin.products.restoreAll');


Route::get('/admin/orders', [HomeController::class, 'viewOrders'])->name('admin.orders.index');
Route::get('/admin/orders/update/{order}', [HomeController::class, 'updateOrderStatusForm'])->name('admin.orders.update');
Route::post('/admin/orders/update', [HomeController::class, 'updateOrderStatus'])->name('admin.orders.updates');
    
// Supplier routes
Route::get('admin/supplier/index', [SupplierController::class, 'index'])->name('supplier.index');
Route::post('admin/supplier/restore-all', [SupplierController::class, 'restoreAll'])->name('supplier.restoreAll');
Route::get('admin/supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
Route::post('admin/supplier/store', [SupplierController::class, 'store'])->name('supplier.store');
Route::get('admin/supplier/update/{id}', [SupplierController::class, 'update'])->name('supplier.update');
Route::put('/admin/supplier/edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit');
Route::get('/admin/supplier/delete/{id}', [SupplierController::class, 'delete'])->name('supplier.delete');

//supplier transaction routes
Route::get('admin/supplytransac/index', [SuppliertransactionController::class, 'index'])->name('supplier_transaction.index');
Route::get('admin/supplytransac/create/{id}', [SuppliertransactionController::class, 'create'])->name('supplier_transaction.create');
Route::post('admin/supplytransac/store', [SuppliertransactionController::class, 'store'])->name('supplier_transaction.store');
Route::get('admin/supplytransac/edit/{id}', [SuppliertransactionController::class, 'edit'])->name('supplier_transaction.edit');
Route::put('admin/supplytransac/update/{id}', [SuppliertransactionController::class, 'update'])->name('supplier_transaction.update');
Route::get('/admin/supplytransac/delete/{id}', [SuppliertransactionController::class, 'delete'])->name('supplier_transaction.delete');

//Courier routes
Route::get('admin/courier/index', [CourierController::class, 'index'])->name('courier.index');
Route::get('admin/courier/create', [CourierController::class, 'create'])->name('courier.create');
Route::post('admin/courier/create', [CourierController::class, 'store'])->name('courier.store');
Route::get('admin/courier/update/{id}', [CourierController::class, 'update'])->name('courier.update');
Route::put('/admin/courier/edit/{id}', [CourierController::class, 'edit'])->name('courier.edit');
Route::delete('/admin/courier/{id}/delete', [CourierController::class, 'delete'])->name('courier.delete'); 
Route::post('/admin/courier/restore/all', [CourierController::class, 'restoreAll'])->name('courier.restoreAll');

//users
Route::get('admin/users/index', [CustomerController::class, 'users'])->name('users.index');
Route::get('admin/users/deactivate/{id}', [CustomerController::class, 'deactivate'])->name('users.deactivate');

Route::get('/admin/dashboard/index', [DashboardController::class, 'graphs'])->name('admin.dashboard.index');
})->middleware(RoleMiddleware::class);

//Payment Method
Route::get('admin/payment_method/index', [PaymentMethodController::class, 'index'])->name('admin.payment_method.index');
Route::get('admin/payment_method/create', [PaymentMethodController::class, 'create'])->name('admin.payment_method.create');
Route::post('admin/payment_method/store', [PaymentMethodController::class, 'store'])->name('admin.payment_method.store');
Route::get('admin/payment_method/update/{id}', [PaymentMethodController::class, 'update'])->name('admin.payment_method.update');
Route::put('admin/payment_method/edit/{id}', [PaymentMethodController::class, 'edit'])->name('admin.payment_method.edit');

//Reviews
Route::get('/customer/reviews/index', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('customer/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/customer/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/customer/reviews/edit',[ReviewController::class,'edit'])->name('reviews.edit');
Route::put('/customer/reviews/update',[ReviewController::class,'update'])->name('reviews.update');
Route::delete('customer/reviews/delete', [ReviewController::class,'destroy'])->name('reviews.delete');
Route::get('/customer/reviews/reviewedProducts', [ReviewController::class, 'reviewedProducts'])->name('reviews.reviewlist');


// para lang to sa pinaka front page
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/products', [HomeController::class, 'products'])->name('products');
Route::get('/product/{id}', [HomeController::class, 'productDetails'])->name('product.details');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/search', [HomeController::class, 'search'])->name('search');

//php artisan db:seed --class=DatabaseSeeder





