<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index($slug, $product) {
        $data = $this->productService->getInfoProduct($product);


    
        $data = [
            'productDetails' => [],
            'colors' => [],
            'brands' => [],
            'categories' => [],
        ];
    

        return view('frontend.products.detail', $data);
    }

}