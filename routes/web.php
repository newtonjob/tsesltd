<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\BulkProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FlyerController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderInvoiceController;
use App\Http\Controllers\OrderWaybillController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalesExportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockExportController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\TransferWaybillController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
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

Route::get('/', HomeController::class)->name('home');
Route::get('/oauth/{provider}/authorize', [OAuthController::class, 'create'])->name('oauth.create');
Route::get('/oauth/{provider}/redirect',  [OAuthController::class, 'store'])->name('oauth.store');

Route::view('/pos',         'pos')->name('pos')->can('point-of-sale');
Route::view('/stores',      'stores')->name('stores');
Route::view('/about-us',    'about-us')->name('about-us');
Route::view('/contact-us',  'contact-us')->name('contact-us');

Route::view('/cart',     'cart')->name('cart')->middleware('cart.filled');
Route::view('/checkout', 'checkout')->name('checkout')->middleware('cart.filled');

Route::middleware('guest')->group(function () {
    Route::view('/login',                   'auth.login')->name('login');
    Route::view('/register',                'auth.register')->name('register');
    Route::view('/reset-password/{token}',  'auth.reset')->name('password.reset');
});

Route::resource('shop', ShopController::class)->only('index', 'show');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard',                DashboardController::class)->name('dashboard');
    Route::get('/stock-export',             StockExportController::class)->name('stock-export');
    Route::get('/sales-export',             SalesExportController::class)->name('sales-export');
    Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class)->name('verification.verify');

    Route::resource('users',               UserController::class)->only('index', 'show');
    Route::resource('roles',               RoleController::class)->only('index', 'show');
    Route::resource('stock',               StockController::class)->only('create');
    Route::resource('orders',              OrderController::class)->only('index', 'show');
    Route::resource('brands',              BrandController::class)->only('index');
    Route::resource('colors',              ColorController::class)->only('index');
    Route::resource('flyers',              FlyerController::class)->only('index');
    Route::resource('reports',             ReportController::class)->only('index');
    Route::resource('products',            ProductController::class)->only('index', 'create', 'edit');
    Route::resource('transfers',           TransferController::class)->only('index', 'show');
    Route::resource('locations',           LocationController::class)->only('index', 'show');
    Route::resource('categories',          CategoryController::class)->only('index', 'create', 'edit');
    Route::resource('users.orders',        UserOrderController::class)->only('index');
    Route::resource('bulk-products',       BulkProductController::class)->only('index');
    Route::resource('sub-categories',      SubCategoryController::class)->only('index');
    Route::resource('locations.transfers', TransferController::class)->only('create');
    Route::singleton('transfers.waybill',  TransferWaybillController::class)->only('show');
    Route::singleton('orders.invoice',     OrderInvoiceController::class)->only('show');
    Route::singleton('orders.waybill',     OrderWaybillController::class)->only('show');
    Route::singleton('settings',           SettingController::class)->only('edit');
});

