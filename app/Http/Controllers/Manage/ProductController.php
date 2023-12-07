<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Http\Resources\Products\Product;
use App\Http\Resources\Products\ProductCollection;
use App\Repositories\Interfaces\ProductRepository;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    protected $productService;
    protected $productRepository;

    public function __construct(ProductRepository $productRepository, ProductService $productService)
    {
        //dd(App::environment());
        $this->productService = $productService;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $data = $this->productRepository->getList($params);
        $products = new ProductCollection($data);
        return view('backend.products.list', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->productService->getInitData();
        return view('backend.products.create', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $data = $this->productService->getInitData();
        $data['products'] = $this->productRepository->find(intval($id));

        return view('backend.products.edit', $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
