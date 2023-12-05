<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class DemoController extends Controller
{
    public function demo() {

        Session::put('account2x', 'tuantv888855555');

        $accountSession = session()->get('account2x');
       // dd($accountSession);

       return view('test');
    }

    public function demo2() {
        $accountSession = session()->get('account2x');
        dd($accountSession);
        echo $accountSession;
        return view('test2');
    }
}
