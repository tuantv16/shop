<?php

namespace App\Services;

use App\Repositories\Interfaces\CategoryRepository;
use App\Repositories\Interfaces\ColumnRepository;
use App\Repositories\Interfaces\NewsRepository;
use App\Repositories\Interfaces\ProductRepository;
use Illuminate\Support\Facades\DB;

class CategoryService extends BaseService
{

    protected $categoryRepository;
    protected $productRepository;

    /**
     *
     */
    public function __construct(
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository

    ) {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function getInitData() {
        $cbCategory = $this->getCbCategory();

        $results = [
            'cbCategory' =>  $cbCategory
        ];

        return $results;

    }


    public function getCbCategory() {
        $categories = $this->categoryRepository->getDataDispOrder();
        if ($categories->isNotEmpty()) {
            $data = $this->recursive($categories->toArray());
            $listData = [];


            $flattenedArray = [];
            $this->flattenArray($data, $flattenedArray);
        }

        return $flattenedArray ?? $categories;
    }

    public function recursive($arr, $p = 0)
    {
        $array = [];
        foreach ($arr as $item) {
            if ($item['parent_id'] == $p) {
                $child =  $this->recursive($arr, $item['id']);
                if (count($child) > 0) {
                    $item['child'] = $child;
                }
                array_push($array,$item);
            }
        }
        return $array;
    }

    function flattenArray($array, &$result = []) {
        foreach ($array as $item) {
            $result[] = $item;

            if (isset($item['child']) && is_array($item['child'])) {
                $this->flattenArray($item['child'], $result);
            }
        }
    }

    // menu ngoài trang frontend shop.html
    public function createMenu() {
        $categories = $this->categoryRepository->getDataDispOrder();
        if ($categories->isNotEmpty()) {
            $categories = $this->recursive($categories->toArray());


            // begin - tính tổng product tương ứng với mỗi cate
            $dataTmps = $this->productRepository->getTotalProductEachCategory();

            if (!empty($dataTmps)) {
                $arrCounts = $dataTmps->pluck('total', 'category_id')->toArray();

                foreach($categories as $key => $row) {
                    $total = 0;
                    foreach($row['child'] as $rew => $item) {
                        if (isset($arrCounts[$item['id']])) {
                            $total  = $arrCounts[$item['id']];
                        }
                        $categories[$key]['child'][$rew]['total'] = $total;
                    }

                }
            }

            // end - tính tổng product tương ứng với mỗi cate
        }

        return $categories;
    }

}
