<?php

namespace App\Services;

use App\Repositories\Interfaces\BrandRepository;
use App\Repositories\Interfaces\CategoryRepository;
use App\Repositories\Interfaces\ProductRepository;
use App\Services\Traits\ImageUpload;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductService extends BaseService
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
        $brands = $this->brandRepository->getDataDispOrder();
        $categories = $this->categoryService->getCbCategory();
        $maxId = $this->productRepository->getMaxId();
        $results = [
            'brands' => $brands,
            'categories' => $categories,
            'maxId' => $maxId
        ];

        return $results;
    }

    public function saveData($data, $request) {
        $configs = config('web.config.uploads');
        $folderName =  $configs['products']; // đặt tên folder

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $nameImage = $this->uploads($file, $folderName) ; // upload (local or S3) and get name file image
            $data['image'] = $nameImage;
            
        }
        $data['product_code'] = $this->getProductCode($data['category_id']); 

        return $this->productRepository->create($data);
    }

    // return string
    public function getProductCode($categoryId) {
        return $this->productRepository->getProductCode($categoryId);
    }

    public function updateData($data, $request) {
        $configs = config('web.config.uploads');
        $folderName =  $configs['products']; // đặt tên folder

        if ($request->hasFile('image') || $data['is_image_deleted'] == 'true') {
            $file = $request->file('image');


            if ($data['is_image_deleted'] == 'true') {
                $data['image'] = '';
            } else {
                $nameImage = $this->uploads($file, $folderName) ; // upload (local or S3) and get name file image. Trường hợp update thì xóa ảnh cũ ở s3
                $data['image'] = $nameImage;
            }

            if (!empty($nameImage) || $data['is_image_deleted'] == 'true') { // Nếu trường hợp upload ảnh thành công lên S3 thì xóa ảnh cũ
                $this->deleteOldImage($folderName, (int) $data['id']);
            }

        } else { // trường hợp update dữ liệu nhưng ảnh vẫn giữ nguyên
            unset($data['image']);
        }

        return $this->productRepository->update($data, (int) $data['id']);
    }

    public function deleteOldImage($folderName, $id) {
         try {
            $dataOld = $this->productRepository->find($id);
            $oldImage = $dataOld->image;
            $pathImage = $folderName.'/'.$oldImage;

            Storage::disk('s3')->delete($pathImage);

            // Xóa thành công
            // Ghi log hoặc thực hiện các công việc khác (nếu cần)

       } catch (\Exception $e) {
             Log::error('Error deleting old image from S3: ' . $e->getMessage());
        }
    }

    public function setupData() {
        $sizes = config('web.config.sizes');
        $colors = config('web.config.colors');
        $prices = config('web.config.prices');

        $brands = $this->brandRepository->getDataDispOrder();
        $categories = $this->categoryService->createMenu();

        $results = [
            'sizes' => $sizes,
            'colors' => $colors,
            'brands' => $brands,
            'prices' => $prices,
            'categories' => $categories
        ];

        return $results;
    }

    public function getInfoProduct($productCode) {
        $results = [];
        $infoProducts = $this->productRepository->getProductByCode($productCode);

        $sizeIds = $infoProducts->productDetails->pluck('size_id')->unique()->toArray();
        $colorIds = $infoProducts->productDetails->pluck('color_id')->unique()->toArray();

        $configSizes = config('web.config.sizes');
        $configColors = config('web.config.colors');
        $filteredConfigSizes = collect($configSizes)->only($sizeIds)->all(); // Chỉ lấy ra danh sách size mà sản phẩm set trong backend
        $filteredConfigColors = collect($configColors)->only($colorIds)->all(); // Chỉ lấy ra danh sách màu mà sản phẩm set trong backend

        $results = [
            'infoProducts' => $infoProducts,
            'sizes' => $filteredConfigSizes,
            'colors' => $filteredConfigColors
        ];

        return $results;
    }



}
