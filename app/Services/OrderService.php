<?php

namespace App\Services;

use App\Repositories\Interfaces\CustomerRepository;
use App\Repositories\Interfaces\OrderRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderService extends BaseService
{

    CONST GUEST = 99;
    protected $orderRepository;
    protected $customerRepository;
    /**
     *
     */
    public function __construct(
        OrderRepository $orderRepository,
        CustomerRepository $customerRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->customerRepository = $customerRepository;
    }

    public function handleOrder($params) {


        $statusOrderSuccess = false;

        try {
           DB::beginTransaction();
                if (!empty($params['infoCustomers'])) {
                    // create customer
                    $infoCustomers = $params['infoCustomers'];
                    $infoCustomers['type'] = !$params['infoCustomers']['agree_account'] ? 99 : NULL;
                    $infoCustomers['city'] = $params['infoCustomers']['province'];

                    $customers = $this->customerRepository->create($infoCustomers);

                }

                //create order
                if (!empty($params['infoOrders'])) {
                    foreach($params['infoOrders'] as $order) {
                        $order['customer_id'] = $customers->id;
                        $this->orderRepository->create($order);
                    }

                }
            DB::commit();
            $statusOrderSuccess = true;
        } catch (Exception $e) {
            DB::rollBack();
        }

        return $statusOrderSuccess;

    }


}
