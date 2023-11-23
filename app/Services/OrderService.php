<?php

namespace App\Services;

use App\Repositories\Interfaces\OrderRepository;

class OrderService extends BaseService
{

    protected $orderRepository;

    /**
     *
     */
    public function __construct(
        OrderRepository $orderRepository
    ) {
        $this->orderRepository = $orderRepository;

    }

    public function getInitData($id) {
        $orders = $this->orderRepository->find(intval($id));

        $results = [
            'orders' => $orders
        ];

        return $results;
    }


}
