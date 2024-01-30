<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Web\Customers\LoginCustomerRequest;
use App\Http\Requests\Web\Customers\RegisterCustomerRequest;
use App\Http\Resources\Customers\Customer;
use App\Repositories\Interfaces\CartRepository;
use App\Repositories\Interfaces\CustomerRepository;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomerController extends ApiController
{

    protected $customerRepository;
    protected $cartService;
    protected $cartRepository;

    public function __construct(
        CustomerRepository $customerRepository,
        CartService $cartService,
        CartRepository $cartRepository
    )
    {
        $this->customerRepository = $customerRepository;
        $this->cartService = $cartService;
        $this->cartRepository = $cartRepository;
    }

    public function register(RegisterCustomerRequest $request) {
        $params = $request->validated();
        $data = $this->customerRepository->register($params);
        return $this->responseSuccess(new Customer($data));
    }

    public function login(LoginCustomerRequest $request)
    {
        $params = $request->validated();
        $customers = $this->customerRepository->login($params);
        Session::put('account', $customers->account);

        $infoAccounts = [
            'customer_id' => $customers->id,
            'account' => $customers->account,
            'customer_name' => $customers->customer_name,
            'phone' => $customers->phone,
            'email' => $customers->email,
        ];

        Session::put('accountLogin', $infoAccounts);

         // Dữ liệu cart được lấy dưới localStorage
         $dataCartLocalStorages = $params['infoCart'];

         //Dữ liệu cart được lấy ở database (table carts)
         $cartDatabases = $this->cartRepository->getCartByCustomerId($customers->id);
         $cartDatabases = $cartDatabases->isNotEmpty() ? $cartDatabases->toArray() : [];
         //set data carts into session
         $this->setCart($dataCartLocalStorages, $cartDatabases); // SESSION CART

        return $this->responseSuccess(new Customer($customers), null );
    }

    public function setCart($cartLocal, $cartDb) {
        $dataResults = [];
        $cartLocal = json_decode($cartLocal, true);

        // Trường hợp 1. Cart Localstorage : tồn tại  - Cart DB : tồn tại
        if (!empty($cartLocal) && !empty($cartDb)) {
            $data1 = $this->cartService->getCartInfoDb($cartLocal);
            $data2 = $this->cartService->getCartInfoDb($cartDb);
            $dataResults = array_merge($data1, $data2);
        }

        // Trường hợp 2. Cart Localstorage : không tồn tại  - Cart DB : tồn tại
        if (empty($cartLocal)) {
            // lấy đầy đủ thông tin cart
            $cartInfoDb = $this->cartService->getCartInfoDb($cartDb);
            $dataResults = $cartInfoDb;
        }

        // Trường hợp 3. Cart Localstorage : tồn tại  - Cart DB : không tồn tại
        if (empty($cartDb)) {
            // lấy đầy đủ thông tin cart
            $cartLocal = $this->cartService->getCartInfoDb($cartLocal);
            $dataResults = $cartLocal;
        }


        Session::put('dataCarts', $dataResults);  // SESSION CART
    }

    public function logout()
    {

        // save to cart (Database)
        $dataCarts = session()->get('dataCarts');
        $result = $this->cartService->saveCart($dataCarts);

        if (!$result) {
            dd('có lỗi xảy ra khi lưu thông tin cart trước khi đăng xuất');
        }

        // xóa session thông tin tài khoản
        session()->forget('account');
        session()->forget('accountLogin');
         // xóa session giỏ hàng
        session()->forget('dataCarts');

        return redirect()->route('main.index');
    }


}
