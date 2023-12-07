<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{

    protected $cartService;

    public function __construct (
        // BrandRepository $brandRepository,
        // CategoryService $categoryService,
        // CategoryRepository $categoryRepository,
        // ProductRepository $productRepository,
        // ProductService $productService,
        // ProductDetailRepository $productDetailRepository
        CartService $cartService
    )
    {
        // $this->brandRepository = $brandRepository;
        // $this->categoryService = $categoryService;
        // $this->categoryRepository = $categoryRepository;
        // $this->productRepository = $productRepository;
        // $this->productService = $productService;
        // $this->productDetailRepository = $productDetailRepository;
        $this->cartService = $cartService;
    }

    public function index(Request $request) {
        $params = $request->all();
        $carts = session()->get('dataCarts', []);
        //$results = $this->cartService->setupData();
        //$dataSearchs = $this->cartService->getListProducts($params);

        //$results['listProducts'] = new ShopProductCollection($dataSearchs);
        return view('frontend.carts.index', [
            'carts' => $carts
        ]);
    }

}
