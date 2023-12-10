<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Api\ApiController;

use App\Services\PaymentService;

class CheckoutController extends ApiController
{
    protected $paymentService;
    public function __construct(PaymentService $paymentService)
    {
       $this->paymentService = $paymentService;
    }



}
