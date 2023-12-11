<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Manage\FormProductRequest;
use App\Http\Resources\Products\Product;
use App\Repositories\Interfaces\ProductRepository;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class ProductControler extends ApiController
{

    protected $productRepository;
    protected $productService;

    public function __construct(ProductRepository $productRepository, ProductService $productService)
    {
        $this->productRepository = $productRepository;
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    //public function store(FormProductRequest $request)
    public function store(FormProductRequest $request)
    {
        $inputDatas = $request->validated();
        $data = $this->productService->saveData($inputDatas, $request);
        return $this->responseSuccess(new Product($data));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FormProductRequest $request, $id)
    {
        // $inputDatas = $request->validated();

        // $data = $this->productService->saveData($inputDatas, $request);
        // return $this->responseSuccess(new Product($data));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateProduct(FormProductRequest $request) {
        $inputDatas = $request->validated();
        $data = $this->productService->updateData($inputDatas, $request);
        Session::flash('success', 'Message lưu thông tin thành công');
        return $this->responseSuccess(new Product($data));
    }


}
