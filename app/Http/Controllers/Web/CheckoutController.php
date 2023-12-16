<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CustomerRepository;
use App\Services\CartService;
use App\Services\CheckoutService;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{


    protected $checkoutService;
    protected $customerRepository;

    public function __construct(CheckoutService $checkoutService, CustomerRepository $customerRepository)
    {
        $this->checkoutService = $checkoutService;
        $this->customerRepository = $customerRepository;
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
        $code = $request->query('code');

        return view('frontend.checkouts.success', [

        ]);

    }
}



