<?php

namespace App\Repositories;

use App\Constants\Constant;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class AreaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CategoryRepositoryEloquent extends BaseRepositoryEloquent implements CategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Category::class;
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
        return $this->model->where('disp', Constant::DISPLAY)
        ->orderBy('level')
        ->get();
    }

}
