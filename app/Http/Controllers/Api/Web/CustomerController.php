<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Web\Customers\LoginCustomerRequest;
use App\Http\Requests\Web\Customers\RegisterCustomerRequest;
use App\Http\Resources\Customers\Customer;
use App\Repositories\Interfaces\CustomerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends ApiController
{

    protected $customerRepository;
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function register(RegisterCustomerRequest $request) {
        $params = $request->validated();
        $data = $this->customerRepository->register($params);
        return $this->responseSuccess(new Customer($data));
    }

    public function login(LoginCustomerRequest $request)
    {
        $params = $request->validated();
        $data = $this->customerRepository->login($params);

        if (empty($data)) {
            return $this->responseFail();
        }

        return $this->responseSuccess(new Customer($data), null, );
    }

}
