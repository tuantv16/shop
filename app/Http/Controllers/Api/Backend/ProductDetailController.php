<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Manage\FormProductRequest;
use App\Http\Requests\Manage\ProductDetails\FormRowsRequest;
use App\Http\Resources\Products\Product;
use App\Repositories\Interfaces\ProductRepository;
use App\Services\ProductDetailService;
use App\Services\ProductService;

class ProductDetailController extends ApiController
{

    protected $productRepository;
    protected $productService;
    protected $productDetailService;

    public function __construct(
        ProductRepository $productRepository,
        ProductService $productService,
        ProductDetailService $productDetailService
    )
    {
        $this->productRepository = $productRepository;
        $this->productService = $productService;
        $this->productDetailService = $productDetailService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function saveMultiRows(FormRowsRequest $request) {
        $inputDatas = $request->validated();
        $this->productDetailService->saveMultiProductDetail($inputDatas);
        return $this->responseSuccess([]);
    }

}
