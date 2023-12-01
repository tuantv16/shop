<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // view truyền biến đến mọi view
        $dataProduct = Product::find(1); // test
        view()->composer('layout.web.header', function ($view) use ($dataProduct) {
            $view->with('master', $dataProduct->product_name);
        });
    }
}
