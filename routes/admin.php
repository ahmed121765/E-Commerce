<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CouponsController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\myAccountController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Auth\AdminController;
use Illuminate\Support\Facades\Route;

/* --------------------- public Routes --------------------- */

Route::group([
    'middleware' => ['guest:admin'],
], function () {

    Route::get('/login/admin', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/login/admin', [AdminController::class, 'store'])->name('login.admin.store');

});

/* --------------------- Protected Routes --------------------- */

Route::group(
    [
        'middleware' => ['auth:admin'],
    ],
    function () {

        Route::get('/home/admin', [HomeController::class, 'index'])->name('home.admin');
        Route::resource('/brands', BrandController::class);
        Route::resource('/Categories', CategoriesController::class);
        Route::resource('/Products', ProductsController::class);
        Route::resource('/myAccount', myAccountController::class);
        Route::put('password-update-admin', [PasswordController::class, 'update'])->name('account.password.update.admin');

        Route::get('/admin/settings', [SettingsController::class, 'index'])
            ->name('admin.settings.index');

        Route::put('/admin/settings', [SettingsController::class, 'update'])
            ->name('admin.settings.update');

        Route::resource('/coupons', CouponsController::class);
        Route::resource('/orders', OrderController::class);
        Route::resource('/sliders', SliderController::class);
        Route::resource('/admin/contact', ContactController::class)->names('admin.contact');
    }
);
