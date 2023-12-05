<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Web\Customers\LoginCustomerRequest;
use App\Http\Requests\Web\Customers\RegisterCustomerRequest;
use App\Http\Resources\Customers\Customer;
use App\Repositories\Interfaces\CustomerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class CustomerController extends ApiController
{

    protected $customerRepository;
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function register(RegisterCustomerRequest $request) {
        // $account = request()->cookie('account');
        // dd($account);
        $params = $request->validated();
        $data = $this->customerRepository->register($params);
        return $this->responseSuccess(new Customer($data));
    }

    public function login(LoginCustomerRequest $request)
    {
        $params = $request->validated();
        $customers = $this->customerRepository->login($params);

        // return response()->json($$customers)->cookie(
        //     'cookie_name', 'value', $minutes, $path, $domain, $secure, $httpOnly
        // );

        return $this->responseSuccess(new Customer($customers), null )->cookie(
            'account', $customers->account, 60, '/', 'http://shop.local'
        );
    }

}
