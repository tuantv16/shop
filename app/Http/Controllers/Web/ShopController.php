<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\Shop\ShopProductCollection;
use App\Repositories\Interfaces\BrandRepository;
use App\Repositories\Interfaces\CategoryRepository;
use App\Repositories\Interfaces\ProductDetailRepository;
use App\Repositories\Interfaces\ProductRepository;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ShopController extends Controller
{

    protected $brandRepository;
    protected $categoryService;
    protected $categoryRepository;
    protected $productRepository;
    protected $productService;
    protected $productDetailRepository;

    public function __construct(
        BrandRepository $brandRepository,
        CategoryService $categoryService,
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository,
        ProductService $productService,
        ProductDetailRepository $productDetailRepository
    )
    {
        $this->brandRepository = $brandRepository;
        $this->categoryService = $categoryService;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->productService = $productService;
        $this->productDetailRepository = $productDetailRepository;
    }

    public function index(Request $request) {

        $params = $request->all();
        $results = $this->productService->setupData();
        $dataSearchs = $this->productRepository->getListProducts($params);
        $results['listProducts'] = new ShopProductCollection($dataSearchs);
        return view('frontend.shops.index', $results);
    }

}
