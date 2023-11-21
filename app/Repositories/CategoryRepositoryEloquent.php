<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Illuminate\Support\Carbon;
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
    public function createCategory($category, $data) {
        dd(333);
        if ($data['category'] == 'columns') {
            $data['category'] = 'column';
        }

        $data['disp_order'] = $this->getDispOrder($data['category']);
        $data['created_at'] = Carbon::now();
        $data['updated'] = Carbon::now();
        return $this->model->create($data);
    }


}
