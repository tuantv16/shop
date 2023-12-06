<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\Products\InfoProduct;
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
        $data['infoProducts'] = new InfoProduct($data['infoProducts']);
        return view('frontend.products.detail', $data);
    }

}
