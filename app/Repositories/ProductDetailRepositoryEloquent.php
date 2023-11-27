<?php

namespace App\Repositories;

use App\Models\ProductDetail;
use App\Repositories\Interfaces\ProductDetailRepository;

/**
 *
 * @package namespace App\Repositories;
 */
class ProductDetailRepositoryEloquent extends BaseRepositoryEloquent implements ProductDetailRepository 
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return ProductDetail::class;
    }

    public function getList($params) {
        // $columns = [
        //     //'products.id',
        //      '*'
        // ];

        // $query = $this->model->select($columns);

        // $columnCategories = ['id', 'category_name'];
        // $columnBrands = ['id', 'name'];
        // $arrWiths = [
        //     'category' => function ($q) use ($columnCategories) {
        //         $q->select($columnCategories);
        //     },
        //     'brand' => function ($q) use ($columnBrands) {
        //         $q->select($columnBrands);
        //     }
        // ];

        // $query->with($arrWiths);

        // $query->orderBy('created_at','desc');

        // return $this->buildForDatatable($query, $params, $columns);
    }

}
