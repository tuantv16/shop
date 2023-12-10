<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use App\Services\CheckoutService;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{


    protected $checkoutService;
    public function __construct(CheckoutService $checkoutService)
    {
       $this->checkoutService = $checkoutService;
    }

    public function index() {
        return view('frontend.checkouts.index', [
            'account' => session()->get('account', '')
        ]);
    }
}



