<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\View;

class CustomerLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Truy cập và xử lý dữ liệu session tại đây
         //$account = session()->get('account', '');

        // Lấy giá trị từ cookie
        $account = $request->cookie('account');

        
        //dd($account);
        //dd($account);
         // Bạn có thể chuyển dữ liệu vào view hoặc thực hiện các thao tác khác
        // view()->share('accountLogin', 111);

        

         $request->attributes->add(['accountLogin' => $account]);

        //  // Kiểm tra người dùng có đăng nhập không
        // if (auth()->check()) {
        //     // Lấy tên người dùng và chia sẻ qua view
        //     $username = auth()->user()->name;
        //     View::share('username', $username);
        // }
         
        return $next($request);
    }
}
