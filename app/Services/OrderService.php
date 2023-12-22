<?php

namespace App\Services;

use App\Repositories\Interfaces\CustomerRepository;
use App\Repositories\Interfaces\OrderDetailRepository;
use App\Repositories\Interfaces\OrderRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Services\Traits\OrderTrait;
use App\Services\Traits\CustomerTrait;
class OrderService extends BaseService
{

    use OrderTrait;
    use CustomerTrait;

    CONST GUEST = 99;
    protected $orderRepository;
    protected $customerRepository;
    protected $orderDetailRepository;

    /**
     *
     */
    public function __construct(
        OrderRepository $orderRepository,
        CustomerRepository $customerRepository,
        OrderDetailRepository $orderDetailRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->customerRepository = $customerRepository;
        $this->orderDetailRepository = $orderDetailRepository;
    }

    public function handleOrder($params) {

        $orderCode = '';

        //try {
           //DB::beginTransaction();
                if (!empty($params['infoCustomers'])) {
                    // create customer
                    $infoCustomers = $params['infoCustomers'];
                    $infoCustomers['type'] = !$params['infoCustomers']['agree_account'] ? 99 : NULL;
                    $infoCustomers['city'] = $params['infoCustomers']['province'];


                    if (!Session::has('accountLogin')) { // Trường hợp khách vãng lai thanh toán (chưa có tài khoản login)
                        // nếu checked (agree_account) mong muốn tạo tài khoản  => tạo account + password
                         // nếu không checked (agree_account), mong muốn tạo tài khoản  => tạo account + password

                        if(!$params['infoCustomers']['agree_account']) {
                            $infoCustomers['account'] = $this->createAccountNameGuest();
                            $infoCustomers['password'] = $this->createPasswordGuest();
                        }

                        $customers = $this->customerRepository->create($infoCustomers);
                        $customerId = $customers->id;
                    } else {
                        $accountLogin = session()->get('accountLogin');
                        $customerId = (int) $accountLogin['customer_id'];
                    }

                }

                //create order
                if (!empty($params['infoOrders'])) {

                    $dataOrders = $this->getFieldsOrders($params['infoOrders'], $params['infoCustomers'],  $customerId);
                    $order = $this->orderRepository->create($dataOrders);
                    $orderCode = $order->order_code;
                    foreach($params['infoOrders'] as $row) {
                        $row['order_code'] = $orderCode;
                        $row['customer_id'] = $customerId;
                        $order->orderDetails()->create($row);
                    }

                }
        //     DB::commit();
        // } catch (Exception $e) {
        //     DB::rollBack();
        // }

        return $orderCode;

    }

    public function getFieldsOrders($infoOrders, $infoCustomers, $customerId) {

        $totalAmount = array_reduce($infoOrders, function($total, $item) {
            return $total + $item['total_amount'];
        }, 0);

        return[
            'order_code' => $this->createOrderCode(),
            'customer_id' => (int) $customerId,
            'total' => $totalAmount,
            'address' => $infoCustomers['address'],
            'email' => $infoCustomers['email'],
            'phone' => $infoCustomers['phone']
        ];

    }


}
