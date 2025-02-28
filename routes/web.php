<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', [UserController::class, 'index'])->name('user.home');



use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\UserCategoryController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserNewsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminContactController;


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);



Route::resource('categories', CategoryController::class);
Route::get('categories/search', [CategoryController::class, 'search'])->name('categories.search');


Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');

// Route::get('/user/dashboard', [UserController::class, 'index'])
//     ->middleware(['auth', 'role:user'])
//     ->name('user.dashboard');

Route::get('/user/dashboard', [UserController::class, 'index'])
    ->name('user.dashboard');

 Route::get('/', function () {
        return redirect()->route('user.dashboard');
    });




Route::get('/category/{id}', [UserCategoryController::class, 'show'])->name('user.category.show');

use Illuminate\Support\Facades\Auth;

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); // Chuyển hướng về trang đăng nhập
})->name('logout');




Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

use App\Http\Controllers\ProductController;

Route::get('products/search', [ProductController::class, 'search'])->name('products.search');
Route::resource('products', ProductController::class)->except(['show']);


// Route để hiển thị sản phẩm theo danh mục
Route::get('/category/{id}', [UserCategoryController::class, 'show'])->name('user.category.show');


// Route để hiển thị chi tiết sản phẩm
Route::get('/product/{id}', [ProductController::class, 'showuser'])->name('product.show');

// tìm kiếm sản phẩm theo danh mục
Route::get('/category/{id}/products', [CategoryController::class, 'show'])->name('category.products');
use App\Http\Controllers\CartController;

Route::middleware(['auth'])->group(function () {
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.index');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::get('cart/checkout', [CartController::class, 'checkoutForm'])->name('cart.checkoutForm');
Route::post('cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/cancel/{order}', [OrderController::class, 'cancel'])->name('orders.cancel');

    Route::post('/orders/delete/{orderId}', [OrderController::class, 'deleteCanceledOrder'])->name('orders.deleteCanceled');

    
});


// Group route dành cho Admin
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/approve', [AdminOrderController::class, 'approve'])->name('orders.approve');
    Route::post('/orders/{order}/update-status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    
});
Route::prefix('admin')->group(function () {
    Route::resource('news', NewsController::class);
});




Route::prefix('admin')->group(function () {
    // Danh sách liên hệ
    Route::get('contacts', [AdminContactController::class, 'index'])
         ->name('admin.contacts.index');

    // Chi tiết liên hệ
    Route::get('contacts/{id}', [AdminContactController::class, 'show'])
         ->name('admin.contacts.show');

    // Xóa liên hệ
    Route::delete('contacts/{id}', [AdminContactController::class, 'destroy'])
         ->name('admin.contacts.destroy');
});


// Danh sách tin
Route::get('/news', [UserNewsController::class, 'index'])->name('user.news.index');

// Chi tiết tin
Route::get('/news/{news}', [UserNewsController::class, 'show'])->name('user.news.show');



// Form liên hệ
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');

// Xử lý lưu liên hệ
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/admin/contacts/{id}/resend', [ContactController::class, 'resendEmail'])->name('admin.contacts.resend');


















