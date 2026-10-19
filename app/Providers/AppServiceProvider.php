<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrapFive();

        View::composer('components.navbar', function ($view) {
            $cartCount = auth()->check()
                ? (int) Cart::where('user_id', auth()->id())->sum('quantity')
                : 0;

            $view->with('cartCount', $cartCount);
        });
    }
}
