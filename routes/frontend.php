<?php

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\myAccounttController;
use App\Http\Controllers\Frontend\orderController;
use App\Http\Controllers\Frontend\PasswordController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\WishlistController;
use Illuminate\Support\Facades\Route;

/* --------------------- public Routes --------------------- */

Route::group([
    'middleware' => ['guest'],
], function () {

    Route::get('/', [HomeController::class, 'index']);
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

});

/* --------------------- Protected Routes --------------------- */

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return redirect()->route('home.user');
    })->name('dashboard');

    Route::get('/search', [HomeController::class, 'search'])->name('home.search');
    Route::get('/home/user', [HomeController::class, 'index'])->name('home.user');
    Route::get('/my-account', [myAccounttController::class, 'index'])->name('my.account');
    Route::put('password-update', [PasswordController::class, 'update'])->name('account.password.update');
    Route::resource('/shops', ShopController::class);

    Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])
        ->name('cart.coupon.apply');

    Route::delete('/cart/remove-coupon', [CartController::class, 'removeCoupon'])
        ->name('cart.coupon.remove');

    Route::resource('cart', CartController::class)
        ->only([
            'index',
            'store',
            'update',
            'destroy',
        ]);

    Route::delete('/cart-clear', [CartController::class, 'clear'])
        ->name('cart.clear');

    Route::resource('/wishlist', WishlistController::class)->only([
        'index',
        'store',
        'update',
        'destroy',
    ]);

    Route::delete('/wishlist-clear', [WishlistController::class, 'clear'])
        ->name('wishlist.clear');

    Route::resource('checkout', CheckoutController::class)
        ->only(['index', 'store']);
    Route::get('/checkout/confirmation/{id}', [CheckoutController::class, 'confirmation'])
        ->name('checkout.confirmation');

    Route::resource('/order', orderController::class)->only(['index', 'show', 'update']);

    Route::resource('contact', ContactController::class);
    Route::get('/about', function () {
        return view('frontend.About.about');
    })->name('about');

    Route::resource('myaccount', myAccounttController::class);

});
