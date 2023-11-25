<?php

namespace App\Services;

use App\Repositories\Interfaces\BrandRepository;
use App\Repositories\Interfaces\CategoryRepository;
use App\Repositories\Interfaces\ProductRepository;
use Illuminate\Support\Facades\DB;

class ProductService extends BaseService
{

    protected $productRepository;
    protected $brandRepository;
    protected $categoryRepository;
    protected $categoryService;
    /**
     *
     */
    public function __construct(
        ProductRepository $productRepository,
        BrandRepository $brandRepository,
        CategoryRepository $categoryRepository,
        CategoryService $categoryService
    ) {
        $this->productRepository = $productRepository;
        $this->brandRepository = $brandRepository;
        $this->categoryRepository = $categoryRepository;
        $this->categoryService = $categoryService;
    }

    public function getInitData() {
        // $sizes = config('web.config.sizes');
        // $colors = config('web.config.colors');
        $brands = $this->brandRepository->getDataDispOrder();
        $categories = $this->categoryService->getCbCategory();

        $results = [
            // 'sizes' => $sizes,
            // 'colors' => $colors,
            'brands' => $brands,
            'categories' => $categories
        ];

        return $results;
    }


    public function saveData($data) {
        return $this->productRepository->create($data);
    }

}
