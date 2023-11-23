<?php

namespace App\Repositories;

use App\Models\Brand;

use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use App\Constants\Constant;
use App\Models\Product;
use App\Repositories\Interfaces\BrandRepository;
use App\Repositories\Interfaces\ProductRepository;

/**
 *
 * @package namespace App\Repositories;
 */
class ProductRepositoryEloquent extends BaseRepositoryEloquent implements ProductRepository 
{

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
    public function boot(): void
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


}
