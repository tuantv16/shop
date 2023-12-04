<?php

namespace App\Repositories;

use App\Models\Brand;

use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use App\Constants\Constant;
use App\Models\Product;
use App\Repositories\Interfaces\BrandRepository;
use App\Repositories\Interfaces\ProductRepository;
use Illuminate\Support\Facades\DB;

/**
 *
 * @package namespace App\Repositories;
 */
class ProductRepositoryEloquent extends BaseRepositoryEloquent implements ProductRepository
{

    CONST LEVEL = 2;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Product::class;
    }

    /**
     * Boot up the repository, pushing criteria
     * @throws RepositoryException
     */
    // public function boot(): void
    // {
    //     $this->pushCriteria(app(RequestCriteria::class));
    // }

    public function getList($params) {
        $columns = [
            //'products.id',
             '*'
        ];

        $query = $this->model->select($columns);

        $columnCategories = ['id', 'category_name'];
        $columnBrands = ['id', 'name'];
        $arrWiths = [
            'category' => function ($q) use ($columnCategories) {
                $q->select($columnCategories);
            },
            'brand' => function ($q) use ($columnBrands) {
                $q->select($columnBrands);
            }
        ];

        $query->with($arrWiths);

        // $query = $query->with(['standards' => function($q) {
        //     $q->with(['details' => function($q2) {
        //         $q2->with(['item_list']);
        //     }]);
        // }]);

        // // search by product_name
        // $query->when($params['product_name'] ?? null, function ($q, $keywords) {
        //     $q->where(function ($q) use ($keywords) {
        //         $q->where('v_product_pro.product', 'like', "%{$keywords}%")
        //             ->orWhere('v_product_pro.product_name', 'like', "%{$keywords}%");
        //     });
        // });

        $query->orderBy('created_at','DESC');

        // $data = $query->get();
        // dd($data->toArray());
        return $this->buildForDatatable($query, $params, $columns);
    }


    public function search($params) {

    }

    public function getTotalProductEachCategory() {
        $query = $this->model->select('category_id', DB::raw('COUNT(products.category_id) as total'));
        $query->with(['category' => function ($query) {
            $query->where('categories.level', self::LEVEL);
        }]);
        $query->groupBy('category_id');
        return $query->get();
    }


    // search màn hình shop.html
    public function getListProducts($params) {
        $columns = [
             '*'
        ];

        $query = $this->model->select($columns);

        $columnProductDetails = ['product_id','size_id', 'color_id', 'brand_id', 'quantity'];

        $relationships = [
            'productDetails' => function ($q) use ($columnProductDetails) {
                $q->select($columnProductDetails);
            }
        ];

        $query->with($relationships);

        // search by keyword
        $query->when($params['keyword'] ?? null, function ($q, $keyword) {
            $q->where('product_name', 'like', "%{$keyword}%");
        });

        // search by category_id
        $query->when($params['category_id'] ?? null, function ($q, $categoryId) {
            $q->whereHas('category', function ($q) use ($categoryId) {
                $q->where('category_id', intval($categoryId));
            });
        });

         // search by brand_id
         $query->when($params['brand_id'] ?? null, function ($q, $brandId) {
            $q->whereHas('brand', function ($q) use ($brandId) {
                $q->where('brand_id', intval($brandId));
            });
        });

        $query->when($params['size_id'] ?? null, function ($q, $sizeId) {
            $q->whereHas('productDetails', function ($query) use ($sizeId) {
                $query->where('size_id', intval($sizeId));
            });
        });

        $query->when($params['color_id'] ?? null, function ($q, $colorId) {
            $q->whereHas('productDetails', function ($query) use ($colorId) {
                $query->where('color_id', intval($colorId));
            });
        });

        $query->when($params['price_range'] ?? null, function ($q, $keyRepresent) {
            $priceRangeArrs = $this->getFromToPrice(intval($keyRepresent));
            $startPrice = $priceRangeArrs['startPrice'];
            $endPrice = $priceRangeArrs['endPrice'];

            if (empty($endPrice)) {
                $q->where('price', '>=', $startPrice);
            } else {
                $q->whereBetween('price', [$startPrice, $endPrice]);
            }
        });

        $query->orderBy('created_at','DESC');

        if (!empty($params['sort_price'])) {
            if ($params['sort_price'] == 'desc') {
                $query->orderBy('price','DESC');
            }

            if ($params['sort_price'] == 'asc') {
                $query->orderBy('price','asc');
            }

        }
        // $data = $query->get();
        // dd($data->toArray());
        return $this->buildForDatatable($query, $params, $columns);
    }


    private function getFromToPrice($key) {
        $startPrice = 0;
        $endPrice = '';

        if ($key == 1) {
            $startPrice = 0;
            $endPrice = 200000;
        }

        if ($key == 2) {
            $startPrice = 200000;
            $endPrice = 500000;
        }

        if ($key == 3) {
            $startPrice = 500000;
            $endPrice = 1000000;
        }

        if ($key == 4) {
            $startPrice = 1000000;
            $endPrice = 2000000;
        }

        if ($key == 5) {
            $startPrice = 2000000;
            $endPrice = 5000000;
        }

        if ($key == 6) {
            $startPrice = 5000000;
            $endPrice = '';
        }

        $results = [
            'startPrice' => $startPrice,
            'endPrice' => $endPrice,
        ];

        return $results;
    }
}
