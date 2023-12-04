<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CustomerRepository;
use App\Services\CartService;
use Illuminate\Http\Request;


class CustomerController extends Controller
{
    protected $customerRepository;

    public function __construct(CustomerRepository $customerRepository) {
        $this->customerRepository = $customerRepository;
    }

    // Register customer
    public function register() {
        $results = [];
        return view('frontend.customers.register', $results);
    }

    // Register customer
    public function login() {
        return view('frontend.customers.login');
    }

}
