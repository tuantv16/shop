<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Web\Carts\AddCartRequest;
use Illuminate\Http\Request;

class CartController extends ApiController
{
    public function __construct()
    {
       
    }

    /**
     * Filter condition get data product (page /shop.html)
     */
    public function addToCart(AddCartRequest $request) {
        $params = $request->all();
        $dataCarts = session()->get('dataCarts');
        
        $this->updateCart($dataCarts, $params['carts']);
   
        // $data = $this->productRepository->getListProducts($params);
        // return $this->responseSuccess(new ShopProductCollection($data));
    }


    public function updateCart($dataCarts, $newRows ) {
        dd($newRows);
        // TH cart không có dữ liệu gì -> $dataCarts = $newRows
        if(empty($dataCarts)) {
            $dataCarts = $newRows;
        }
        
        if(!empty($dataCarts)) {
          
            //$dataCarts = $newRows;
        }
        
      
        // TH cart dữ liệu product, color_id, size_id trùng nhau thì 
    }
}
