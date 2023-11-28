<?php

namespace App\Services;

use App\Repositories\Interfaces\BrandRepository;
use App\Repositories\Interfaces\CategoryRepository;
use App\Repositories\Interfaces\ProductRepository;
use App\Services\Traits\ImageUpload;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductDetailService extends BaseService
{
    use ImageUpload;
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
        $sizes = config('web.config.sizes');
        $colors = config('web.config.colors');
        $brands = $this->brandRepository->getDataDispOrder();
        $results = [
            'sizes' => $sizes,
            'colors' => $colors,
            'brands' => $brands
        ];

        return $results;
    }

    public function saveData($data, $request) {
        // $configs = config('web.config.uploads');
        // $destinationPath =  $configs['products']; // đặt tên folder

        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $nameImage = $this->uploads($file, $destinationPath) ; // upload (local or S3) and get name file image
        //     $data['image'] = $nameImage;
        // }

        // return $this->productRepository->create($data);
    }

    public function saveMultiProductDetail($params) {
        dd($params);
    }

}