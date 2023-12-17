<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CustomerRepository;
use App\Repositories\Interfaces\OrderRepository;
use App\Services\CartService;
use App\Services\CheckoutService;
use App\Services\OrderService;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{


    protected $checkoutService;
    protected $customerRepository;
    protected $orderRepository;

    public function __construct(
        CheckoutService $checkoutService,
        CustomerRepository $customerRepository,
        OrderRepository $orderRepository,
    )
    {
        $this->checkoutService = $checkoutService;
        $this->customerRepository = $customerRepository;
        $this->orderRepository = $orderRepository;
    }

    public function index() {

        // info Cart (case customer Login)

        $dataCartSession = session()->get('dataCarts', []);
        $accountLogin = session()->get('accountLogin', '');

        $customerLogin = [];
        if (!empty($accountLogin)) {
            $customerLogin = $this->customerRepository->find($accountLogin['customer_id'])->toArray();
        }

        return view('frontend.checkouts.index', [
            'account' => session()->get('account', ''),
            'customerLogin' => $customerLogin,
            'dataCartSession' => $dataCartSession
        ]);
    }

    public function checkoutSuccess(Request $request) {
        $orderCode = $request->query('code');
        $data = $this->orderRepository->getDataByOrderCode($orderCode);
        dd($data);
        return view('frontend.checkouts.success', [
            'data' => $data
        ]);

    }
}



