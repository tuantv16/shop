<?php
namespace App\Providers;

use App\Services\Image\ImageService;
use Illuminate\Support\ServiceProvider;


class ImageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ImageService::class, function ($app) {
            return new ImageService();
        });
    }
}
