<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\products\ProductController;
use App\Http\Controllers\categories\CategoryController;

use App\Http\Controllers\admin\AdminProductController;
use App\Http\Controllers\admin\AdminCategoryController;
use App\Http\Controllers\admin\AdminOrdersController;
use App\Http\Controllers\admin\AdminUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Đây là nơi bạn định nghĩa các route cho API của mình.
| Mặc định sẽ được gán middleware "api".
| Route này dành cho frontend hoặc mobile gọi API.
*/

// ========== Xác thực ==========
Route::post('/login', [AuthController::class, 'login']);

// Trả về thông tin người dùng sau khi đăng nhập
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ========== Public API ==========
Route::get('/products', [ProductController::class, 'index']);   // Lấy danh sách sản phẩm
Route::get('/product/{id}', [ProductController::class, 'show']); // Lấy chi tiết sản phẩm

Route::resource('categories', CategoryController::class)->only(['index', 'show']); // Danh mục công khai

// ========== Admin API ==========
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    // Quản lý sản phẩm
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::patch('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    // Quản lý danh mục nâng cao
    Route::resource('categories', CategoryController::class)->except(['index', 'show']);

    // Quản lý qua controller riêng cho admin
    Route::resource('product', AdminProductController::class);
    Route::resource('category', AdminCategoryController::class);
    Route::resource('order', AdminOrdersController::class);
    Route::resource('user', AdminUserController::class);
});
    