<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Api\Auth\NewPasswordController;
use App\Http\Controllers\Api\Auth\PasswordResetLinkController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\BulkProductController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CartProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ColorController;
use App\Http\Controllers\Api\DispatchedOrderController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\NewUserController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PosOrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductImageController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\StockController;
use App\Http\Controllers\Api\StockShortageController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\TransferController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login',           [AuthController::class, 'store'])->name('login');
Route::delete('/logout',        [AuthController::class, 'destroy'])->name('logout');
Route::post('/register',        [NewUserController::class, 'store'])->name('register');
Route::post('forgot-password',  [PasswordResetLinkController::class, 'store'])->name('password.forgot');
Route::post('reset-password',   [NewPasswordController::class, 'store'])->name('password.reset');

Route::apiSingleton('cart',             CartController::class)->destroyable()->only('destroy');
Route::apiResource('orders',            OrderController::class)->only('store');
Route::apiSingleton('products.cart',    CartProductController::class)->creatable()->except(['index', 'show']);

Route::middleware('auth')->group(function () {
    Route::apiResource('pos',                   PosOrderController::class)->only('store');
    Route::apiResource('users',                 UserController::class)->only('store', 'update', 'destroy');
    Route::apiResource('stock',                 StockController::class)->only('store', 'destroy');
    Route::apiResource('brands',                BrandController::class)->except('index', 'show');
    Route::apiResource('colors',                ColorController::class)->except('index', 'show');
    Route::apiResource('orders',                OrderController::class)->only('update', 'destroy');
    Route::apiResource('roles',                 RoleController::class)->except('index', 'show');
    Route::apiResource('products',              ProductController::class)->only( 'store', 'update', 'destroy');
    Route::apiSingleton('settings',             SettingController::class)->only('update');
    Route::apiResource('locations',             LocationController::class)->except('index', 'show');
    Route::apiResource('categories',            CategoryController::class)->only('store', 'update');
    Route::apiSingleton('bulk-products',        BulkProductController::class)->only('update');
    Route::apiResource('sub-categories',        SubCategoryController::class)->except('index', 'show');
    Route::apiResource('products.images',       ProductImageController::class)->only('store', 'destroy')->shallow();
    Route::apiResource('locations.transfers',   TransferController::class)->only('store');
    Route::apiResource('orders.transactions',   TransactionController::class)->only('store');
    Route::apiResource('transactions',          TransactionController::class)->only('destroy');

    Route::post('orders/{order}/dispatch',  DispatchedOrderController::class)->name('orders.dispatch');
    Route::post('/email/verify',            EmailVerificationNotificationController::class)->name('verification.resend');
});
