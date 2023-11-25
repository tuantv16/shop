<?php

namespace App\Repositories;

use App\Models\Brand;

use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use App\Constants\Constant;
use App\Repositories\Interfaces\BrandRepository;

/**
 *
 * @package namespace App\Repositories;
 */
class BrandRepositoryEloquent extends BaseRepositoryEloquent implements BrandRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Brand::class;
    }

    /**
     * Boot up the repository, pushing criteria
     * @throws RepositoryException
     */
    public function boot(): void
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function getDataDispOrder() {
        return $this->model->where('disp', Constant::DISPLAY)->orderBy('disp_order')->get();
    }

}
