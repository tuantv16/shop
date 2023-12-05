<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Http\Request;
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

        $data = [
            'pram_1' => 1,
            'pram_2' => 2,
            // ...
        ];

        // view()->composer('layout.web.header', function ($view) use ($data) {
        //     $accountLogin = session()->get('account');
        //     //var_dump($accountLogin);
        //     $data['accountLogin'] = $accountLogin;
        //     $view->with($data);
        // });

        view()->composer('layout.web.header', function ($view) {
            $account = session()->get('account', ''); // Mặc định là chuỗi rỗng nếu không tồn tại
            $view->with(['accountLogin' => $account]);
        });

        //dd(111);

      
    }

}
