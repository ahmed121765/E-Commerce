<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Wearepixel\Cart\Facades\CartFacade as Cart;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('frontend.layouts.master', function ($view) {
            $cartCount = Cart::getTotalQuantity();
            $view->with('cartCount', $cartCount);
        });
    }
}
