<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Api\ApiController;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends ApiController
{
    protected $orderService;
    public function __construct(OrderService $orderService)
    {
       $this->orderService = $orderService;
    }

    public function saveOrder(Request $request) {
        $params = $request->all();
        $this->orderService->handleOrder($params); // create new order and can create new customer

    }
}
