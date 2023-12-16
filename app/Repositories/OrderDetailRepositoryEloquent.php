<?php

namespace App\Repositories;

use App\Models\OrderDetail;
use App\Repositories\Interfaces\OrderDetailRepository;

/**
 *
 * @package namespace App\Repositories;
 */
class OrderDetailRepositoryEloquent extends BaseRepositoryEloquent implements OrderDetailRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return OrderDetail::class;
    }

}
