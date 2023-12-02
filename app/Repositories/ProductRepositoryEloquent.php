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
}
