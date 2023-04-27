<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('landing.page');
Route::get('/product-detail/{productId}', [HomeController::class, 'detail'])->name('product.detail');
Route::get('/testing', [HomeController::class, 'testing'])->name('testing');
Route::post('/product-buy/{productId}', [HomeController::class, 'productBuy'])->name('product.buy');
Route::get('/order-confirm/{orderId}', [HomeController::class, 'orderConfirm'])->name('order.confirm');
Route::get('/order-thank-you', [HomeController::class, 'orderThankyou'])->name('order.thankYou');

/*User Access for project Manage*/
Route::prefix('admin')->group(function () {
    Route::view('/auth-login', 'admin.login')->name('admin.view.login');
    Route::post('/login-process', [AuthController::class, 'loginProcess'])->name('admin.login.process');

    Route::group([ 'middleware' => 'admin.auth'], function () {
        Route::get('/all-products', [ProductController::class, 'index'])->name('admin.product.list');
        Route::get('/add-edit-product/{productId?}', [ProductController::class, 'addEditProduct'])->name('admin.manage.product');
        Route::post('/save-product/{productId?}', [ProductController::class, 'saveProduct'])->name('admin.save.product');
        Route::get('/delete-product/{productId?}', [ProductController::class, 'deleteProduct'])->name('admin.delete.product');

        Route::get('/logout-process', [AuthController::class, 'logoutProcess'])->name('admin.logout.process');
    });
});
