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
use Illuminate\Support\Facades\Session;

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

        //set Cart
        if (!empty($params['infoCart'])) {
            $this->setCart($params['infoCart']); // $params['infoCart'] dữ liệu lưu dưới localStoreAge
        }

        // $carts = session()->get('dataCarts');
        // dd($carts);
        $customers = $this->customerRepository->login($params);
        Session::put('account', $customers->account);
        return $this->responseSuccess(new Customer($customers), null );
    }

    public function setCart($infoCart) {
        $cartArrs = json_decode($infoCart, true);
        Session::put('dataCarts', $cartArrs);
    }

    public function logout()
    {
        // xóa session thông tin tài khoản
        session()->forget('account');

         // xóa session giỏ hàng
        session()->forget('dataCarts');

        return redirect()->route('main.index');
    }

}
