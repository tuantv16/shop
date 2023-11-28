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

    }

    public function getListDataByProductId($productId) {
        return $this->model->where([
            'disp'=> 1,
            'product_id' => intval($productId)
        ])
        ->orderby('updated_at')->get();
    }

}
