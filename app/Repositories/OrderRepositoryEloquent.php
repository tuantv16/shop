<?php

namespace App\Repositories;

use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use App\Constants\Constant;
use App\Models\Order;
use App\Repositories\Interfaces\OrderRepository;

/**
 *
 * @package namespace App\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepositoryEloquent implements OrderRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Order::class;
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
        return $this->model->where('disp', Constant::DISPLAY)->get();
    }

}
