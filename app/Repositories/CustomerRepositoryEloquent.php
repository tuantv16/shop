<?php

namespace App\Repositories;

use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use App\Models\Customer;
use App\Repositories\Interfaces\CustomerRepository;

/**
 *
 * @package namespace App\Repositories;
 */
class CustomerRepositoryEloquent extends BaseRepositoryEloquent implements CustomerRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Customer::class;
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
    // public function getDataDispOrder() {
    //     return $this->model->where('disp', Constant::DISPLAY)->get();
    // }

}
