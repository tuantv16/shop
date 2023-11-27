<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Http\Resources\Products\Product;
use App\Http\Resources\Products\ProductCollection;
use App\Repositories\Interfaces\ProductDetailRepository;
use App\Repositories\Interfaces\ProductRepository;
use App\Services\ProductDetailService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class ProductDetailController extends Controller
{

    protected $productDetailService;
    protected $productDetailRepository;

    public function __construct(ProductDetailRepository $productDetailRepository, ProductDetailService $productDetailService)
    {
        $this->productDetailService = $productDetailService;
        $this->productDetailRepository = $productDetailRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->productDetailService->getInitData();
        return view('backend.product_details.create', $data);
    }

}
