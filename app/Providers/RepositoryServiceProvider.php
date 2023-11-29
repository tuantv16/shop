<?php

namespace App\Providers;

use App\Repositories\BrandRepositoryEloquent;
use App\Repositories\CartRepositoryEloquent;
use App\Repositories\CategoryRepositoryEloquent;
use App\Repositories\CustomerRepositoryEloquent;
use App\Repositories\FeedbackRepositoryEloquent;
use App\Repositories\Interfaces\BrandRepository;
use App\Repositories\Interfaces\CartRepository;
use App\Repositories\Interfaces\CategoryRepository;
use App\Repositories\Interfaces\CustomerRepository;
use App\Repositories\Interfaces\FeedbackRepository;
use App\Repositories\Interfaces\OrderRepository;
use App\Repositories\Interfaces\ProductDetailRepository;
use App\Repositories\Interfaces\ProductRepository;
use App\Repositories\Interfaces\SurveyRepository;
use App\Repositories\OrderRepositoryEloquent;
use App\Repositories\ProductDetailRepositoryEloquent;
use App\Repositories\ProductRepositoryEloquent;
use App\Repositories\SurveyRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryRepository::class, CategoryRepositoryEloquent::class);
        $this->app->bind(BrandRepository::class, BrandRepositoryEloquent::class);
        $this->app->bind(CustomerRepository::class, CustomerRepositoryEloquent::class);
        $this->app->bind(CartRepository::class, CartRepositoryEloquent::class);
        $this->app->bind(ProductRepository::class, ProductRepositoryEloquent::class);
        $this->app->bind(OrderRepository::class, OrderRepositoryEloquent::class);
        $this->app->bind(ProductDetailRepository::class, ProductDetailRepositoryEloquent::class);
        $this->app->bind(SurveyRepository::class, SurveyRepositoryEloquent::class);
        $this->app->bind(FeedbackRepository::class, FeedbackRepositoryEloquent::class);

    }


    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
