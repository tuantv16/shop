<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    protected $cartService;

    protected $paymentService;
    public function __construct(PaymentService $paymentService)
    {
       $this->paymentService = $paymentService;
    }

}
