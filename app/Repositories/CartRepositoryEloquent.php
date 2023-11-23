<?php

namespace App\Repositories;

use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use App\Models\Cart;
use App\Repositories\Interfaces\CartRepository;

/**
 *
 * @package namespace App\Repositories;
 */
class CartRepositoryEloquent extends BaseRepositoryEloquent implements CartRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Cart::class;
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
