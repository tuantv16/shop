<?php

namespace App\Services;

use App\Repositories\Interfaces\CategoryRepository;
use App\Repositories\Interfaces\ColumnRepository;
use App\Repositories\Interfaces\NewsRepository;
use Illuminate\Support\Facades\DB;

class CategoryService extends BaseService
{

    protected $categoryRepository;
    protected $columnRepository;
    protected $newsRepository;

    /**
     *
     */
    public function __construct(
        CategoryRepository $categoryRepository,

    ) {
        $this->categoryRepository = $categoryRepository;

    }

    public function getInitData() {
        $categories = $this->categoryRepository->getDataDispOrder();
        if ($categories->isNotEmpty()) {
            $data = $this->recursive($categories->toArray());
            $listData = [];


            $flattenedArray = [];
            $this->flattenArray($data, $flattenedArray);
        }



        $results = [
            //'cbCategory' => $categories->isNotEmpty() ?  json_encode($categories->toArray()) : []
            'cbCategory' => $flattenedArray ?? $categories
        ];

        return $results;

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

}
