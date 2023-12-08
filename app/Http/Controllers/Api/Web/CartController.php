<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Web\Carts\AddCartRequest;
use App\Http\Requests\Web\Carts\UpdateCartRequest;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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


    // màn hình giỏ hàng. Sau khi click button Cập nhật giỏ hàng
    public function updateCart(UpdateCartRequest $request) {
        $data = $request->validated();
        Session::put('dataCarts', $data['carts']);
        return $this->responseSuccess([]);
    }
}
