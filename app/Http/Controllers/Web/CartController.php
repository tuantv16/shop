<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{

    protected $cartService;

    public function __construct (

        CartService $cartService
    )
    {


        $this->cartService = $cartService;
    }

    public function index(Request $request) {
        //$params = $request->all();
        $carts = session()->get('dataCarts', []);

        return view('frontend.carts.index', [
            'carts' => $carts,
            'account' => session()->get('account', '')
        ]);
    }

}
