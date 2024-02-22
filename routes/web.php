<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Pengguna\CartController;
use App\Http\Controllers\Pengguna\HomeController;
use App\Http\Controllers\Pengguna\ShopController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LogoutController;
use App\Http\Controllers\Pengguna\AboutController;
use App\Http\Controllers\Pengguna\PaymentController;
use App\Http\Controllers\Pengguna\CheckoutController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ShippingAddress;
use App\Http\Controllers\GetCityController;
use App\Http\Controllers\Pengguna\CheckShipping;
use App\Http\Controllers\Pengguna\InfoOrderController;
use App\Http\Controllers\Pengguna\DetailShopController;
use App\Http\Controllers\Pengguna\LogoutController as PenggunaLogoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/





Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/shop_category/{id}', [ShopController::class, 'category'])->name('shop_category');
Route::get('/shop_filter', [ShopController::class, 'filter'])->name('shop_filter');
Route::get('/detail-shop/{id}', [DetailShopController::class, 'index'])->name('detail-shop');
Route::post('/detail-shop', [DetailShopController::class, 'store'])->name('detail-add');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::post('/get-city', [GetCityController::class, 'getCity'])->name('getCity');

Route::middleware(['guest'])->group(function () {
    // bagian login dan registrasi
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'loginStore']);
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerStore']);
    Route::get('/verify/{verify_key}', [AuthController::class, 'verify']);
});
Route::middleware(['auth'])->group(function () {

    // Bagian User
    Route::redirect('/home', '/');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware('HakAksesUser');
    Route::post('/add-cart', [CartController::class, 'add_cart'])->name('add_cart')->middleware('HakAksesUser');
    Route::post('/cart-To-Checkout', [CartController::class, 'cartToCheckout'])->name('cartToCheckout')->middleware('HakAksesUser');
    Route::put('/cart-update/{id}', [CartController::class, 'update'])->name('cart.update')->middleware('HakAksesUser');
    Route::delete('/cart-delete/{id}', [CartController::class, 'destroy'])->name('cart.destroy')->middleware('HakAksesUser');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout')->middleware('HakAksesUser');
    Route::post('/checkout-data', [CheckoutController::class, 'data_customer'])->name('data_customer')->middleware('HakAksesUser');
    Route::post('/pilih-ongkir', [CheckShipping::class, 'cekOngkir'])->name('cekOngkir')->middleware('HakAksesUser');
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment')->middleware('HakAksesUser');
    Route::post('/payment', [PaymentController::class, 'prosessToTransaksi'])->name('prosessToTransaksi')->middleware('HakAksesUser');
    Route::get('/info-order', [InfoOrderController::class, 'index'])->name('info_order')->middleware('HakAksesUser');
    Route::get('/info-order/{id}', [InfoOrderController::class, 'show'])->name('info.show')->middleware('HakAksesUser');
    Route::delete('/info-delete/{id}', [InfoOrderController::class, 'destroy'])->name('info.destroy')->middleware('HakAksesUser');
    Route::get('/profil-user', [ProfilController::class, 'profilUser'])->name('profilUser')->middleware('HakAksesUser');
    Route::put('/profil-user', [ProfilController::class, 'updateUser'])->middleware('HakAksesUser');
    Route::put('/change-password-user', [ProfilController::class, 'change_password_user'])->name('change_password_user')->middleware('HakAksesUser');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::middleware(['auth'])->group(function () {

    // Bagian Admin
    Route::redirect('/home', '/dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('HakAksesAdmin');
    Route::resource('/category', CategoryController::class)->middleware('HakAksesAdmin');
    Route::resource('/product', ProductController::class)->middleware('HakAksesAdmin');
    Route::resource('/pengguna', PenggunaController::class)->middleware('HakAksesAdmin');
    Route::resource('/slider', SliderController::class)->middleware('HakAksesAdmin');
    Route::resource('/order', OrderController::class)->middleware('HakAksesAdmin');
    Route::resource('/shipping-address', ShippingAddress::class)->except(['show'])->middleware('HakAksesAdmin');
    Route::get('/profil-admin', [ProfilController::class, 'profilAdmin'])->name('profilAdmin')->middleware('HakAksesAdmin');
    Route::put('/profil-admin', [ProfilController::class, 'updateAdmin'])->middleware('HakAksesAdmin');
    Route::get('/change-password-admin', [ProfilController::class, 'change_password_admin'])->name('change_password_admin')->middleware('HakAksesAdmin');
    Route::put('/change-password-admin', [ProfilController::class, 'change_password'])->middleware('HakAksesAdmin');
    Route::get('/report-sales', [ReportController::class, 'sales'])->name('sales')->middleware('HakAksesAdmin');
    Route::get('/report-sales-pdf', [ReportController::class, 'salesData'])->name('salesData')->middleware('HakAksesAdmin');
    Route::get('/report-sales-print/{salesStart}/{salesEnd}', [ReportController::class, 'print'])->name('print')->middleware('HakAksesAdmin');
    Route::get('/report-sales-excel/{salesStart}/{salesEnd}', [ReportController::class, 'excelSales'])->name('excelSales')->middleware('HakAksesAdmin');
    Route::get('/report-finance', [ReportController::class, 'finance'])->name('finance')->middleware('HakAksesAdmin');
    Route::get('/report-finance-pdf', [ReportController::class, 'financeData'])->name('financeData')->middleware('HakAksesAdmin');
    Route::get('/report-finance-print/{financeStart}/{financeEnd}', [ReportController::class, 'printFinance'])->name('printFinance')->middleware('HakAksesAdmin');
    Route::get('/report-finance-excel/{financeStart}/{financeEnd}', [ReportController::class, 'excelFinance'])->name('excelFinance')->middleware('HakAksesAdmin');
});
