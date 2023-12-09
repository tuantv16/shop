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

    public function deleteCartByCustomerId($customerId) {
        return $this->model->where('customer_id', intval($customerId))->delete();
    }

    public function getCartByCustomerId($customerId) {
        return $this->model->where('customer_id', intval($customerId))->get();
    }
}
