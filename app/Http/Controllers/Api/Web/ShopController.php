<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Manage\FormBrandRequest;
use App\Http\Resources\Brands\Brand;
use App\Http\Resources\Categories\CategoryCollection;
use App\Http\Resources\ProductDetails\ProductDetail;
use App\Http\Resources\ProductDetails\ProductDetailCollection;
use App\Http\Resources\Shop\ShopProductCollection;
use App\Repositories\Interfaces\BrandRepository;
use App\Repositories\Interfaces\ProductDetailRepository;
use App\Repositories\Interfaces\ProductRepository;
use App\Services\BrandService;
use Illuminate\Http\Request;

class ShopController extends ApiController
{
    protected $productRepository;
    protected $productDetailRepository;
    public function __construct(ProductRepository $productRepository, ProductDetailRepository $productDetailRepository)
    {
        $this->productDetailRepository = $productDetailRepository;
        $this->productRepository = $productRepository;
    }


    /**
     * Filter condition get data product (page /shop.html)
     */
    public function getListProducts(Request $request) {
        $params = $request->all();

        $data = $this->productRepository->getListProducts($params);
        return $this->responseSuccess(new ShopProductCollection($data));
    }
}
