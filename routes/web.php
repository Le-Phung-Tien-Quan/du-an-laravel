<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\products\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\VnpayController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AdminProductController;
use App\Http\Controllers\admin\AdminCategoryController;
use App\Http\Controllers\admin\AdminOrdersController;
use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\CheckAdmin;

/*
|---------------------------------------------------------------------------
| Định nghĩa các tuyến đường (Route) cho website
|---------------------------------------------------------------------------
*/

// ========== Trang công khai (public) ==========
// Trang chủ yêu cầu người dùng đã đăng nhập
Route::get('/', [PageController::class, 'home'])->middleware('auth');

// Trang cửa hàng
Route::get('/shop', [ProductController::class, 'shop']);

// Chi tiết sản phẩm
Route::get('/detail/{slug}', [ProductController::class, 'detail']);

// Trang liên hệ
Route::get('/contact', [PageController::class, 'contact']);

// ========== Thanh toán ==========
// Tạo giao dịch thanh toán
Route::post('/payment', [VnpayController::class, 'create']);

// Kết quả thanh toán
Route::get('/payment/result', [VnpayController::class, 'result']);

// ========== Giỏ hàng ==========
// Các chức năng CRUD cho giỏ hàng
Route::resource('cart', CartController::class);

// Các route dưới đây yêu cầu người dùng phải đăng nhập
Route::middleware('auth')->group(function () {
    // Hiển thị danh sách đơn hàng của người dùng
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    // Hiển thị chi tiết đơn hàng
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

// ========== Người dùng đã đăng nhập ==========
// Các route sau yêu cầu người dùng đăng nhập
Route::middleware('auth')->group(function () {
    // Hồ sơ người dùng
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    // Chỉnh sửa hồ sơ
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    // Cập nhật hồ sơ
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Xóa hồ sơ
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cập nhật giỏ hàng
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/update/{id}', [CartController::class, 'updateQuantity']);
    Route::delete('/cart/remove/{id}', [CartController::class, 'destroy'])->name('cart.remove');

    // Tìm kiếm và lọc sản phẩm theo danh mục
    Route::get('/category/{categoryId}', [ProductController::class, 'categoryProducts']);
    Route::get('/search', [ProductController::class, 'search'])->name('search');
});

// ========== Trang dashboard ==========
// Trang dashboard yêu cầu người dùng đã xác thực
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ========== Khu vực quản trị (Admin) ==========
// Các route dưới đây yêu cầu người dùng có quyền admin
Route::prefix('admin')->middleware([CheckAdmin::class])->group(function () {
    // Trang chính của admin
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin');

    // Quản lý sản phẩm và danh mục
    Route::resource('product', AdminProductController::class);
    Route::resource('category', AdminCategoryController::class);

    // Quản lý đơn hàng
    Route::resource('order', AdminOrdersController::class)->only(['index', 'update']);

    // Quản lý người dùng
    Route::resource('user', AdminUserController::class);
});

// ========== Xác thực (đăng nhập/đăng ký) ==========
// Các route xác thực sẽ được tự động thêm từ tệp auth.php
require __DIR__.'/auth.php';
