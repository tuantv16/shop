<?php

namespace App\Services;

use App\Repositories\Interfaces\BrandRepository;
use App\Repositories\Interfaces\CategoryRepository;
use App\Repositories\Interfaces\ProductDetailRepository;
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
    protected $productDetailRepository;

    /**
     *
     */
    public function __construct(
        ProductRepository $productRepository,
        BrandRepository $brandRepository,
        CategoryRepository $categoryRepository,
        CategoryService $categoryService,
        ProductDetailRepository $productDetailRepository
    ) {
        $this->productRepository = $productRepository;
        $this->brandRepository = $brandRepository;
        $this->categoryRepository = $categoryRepository;
        $this->categoryService = $categoryService;
        $this->productDetailRepository = $productDetailRepository;
    }

    public function getInitData($params) {
        $sizes = config('web.config.sizes');
        $colors = config('web.config.colors');
        $brands = $this->brandRepository->getDataDispOrder();
        $productDetails = $this->productDetailRepository->getListDataByProductId($params['productId']);
        $results = [
            'sizes' => $sizes,
            'colors' => $colors,
            'brands' => $brands,
            'productDetails' => $productDetails
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

        DB::beginTransaction();

        try {

            $this->productDetailRepository->where('product_id', (int) $params['product_id'])->delete();
            $rows = $params['rows'];
            foreach ($rows as $dataInsert) {
                $dataInsert['product_id'] = intval($params['product_id']);
                $this->productDetailRepository->create($dataInsert);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            // Xử lý lỗi hoặc ném lại ngoại lệ
            throw $e;
        }

        return true;
    }

}
