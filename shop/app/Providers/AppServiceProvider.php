<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
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
        View::composer('*', function ($view) {
            $cartItemCount = auth()->check()
                ? Cart::where('user_id', auth()->id())->sum('quantity')
                : array_sum(array_column(session('cart', []), 'quantity'));
    
            $view->with('cartItemCount', $cartItemCount);
        });
    }
}
