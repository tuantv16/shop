<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
class MainController extends Controller
{

    public function __construct() {

    }

    public function index(Request $request) {

        $accountLogin = session()->get('account', '');
        return view('layout.web', [
            'accountLogin' => $accountLogin
        ]);
    }





}
