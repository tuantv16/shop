<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cookie;

class MainController extends Controller
{

    public function __construct() {

    }

    public function index(Request $request) {
        $accountLogin = $request->get('accountLogin');

        $account = request()->cookie('account');
        dd($account);

       // dd($accountLogin);

    //    session()->put('account','tuantv2222');

    //     $all = session()->all();
    //     dd(session()->get('account'));

    //     $accountLogin = '';
    //     if (session()->has('account')) {
    //         $accountLogin = session()->get('account');
    //         dd($accountLogin);
    //     }
    //    dd($accountLogin);

        return view('layout.web', [
            // 'accountLogin' => $accountLogin
        ]);
    }


    


}
