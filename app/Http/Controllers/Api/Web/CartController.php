<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Web\Carts\AddCartRequest;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends ApiController
{
    protected $cartService;
    public function __construct(CartService $cartService)
    {
       $this->cartService = $cartService;
    }

    /**
     * Filter condition get data product (page /shop.html)
     */
    public function addToCart(AddCartRequest $request)
    {
        $params = $request->all();

        // merge cart, update cart, get info detail product from database
        $status = $this->cartService->handleCart($params['products']);

        if ($status) {
            return $this->responseSuccess($status);
        } else {
            return $this->responseFail('Add Product To Cart Fail');
        }

    }

}
