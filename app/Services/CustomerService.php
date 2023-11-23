<?php

namespace App\Services;

use App\Repositories\Interfaces\BrandRepository;
use App\Repositories\Interfaces\CustomerRepository;
use Illuminate\Support\Facades\DB;

class CustomerService extends BaseService
{

    protected $customerRepository;

    /**
     *
     */
    public function __construct(
        CustomerRepository $customerRepository
    ) {
        $this->customerRepository = $customerRepository;

    }

    public function getInitData($id) {
        $customers = $this->customerRepository->find(intval($id));

        $results = [
            'customers' => $customers
        ];

        return $results;
    }


}
