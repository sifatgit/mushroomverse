<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use App\Models\Setting;
use App\Models\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {   
        $carts = Cart::totalCarts();
        Paginator::useBootstrapFour();
        $setting = Setting::first();
        view()->share([
            'setting' => $setting,
            'carts' => $carts
    ]);
        Schema::defaultStringLength(191);
    }
}
