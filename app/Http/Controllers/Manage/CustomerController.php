<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CustomerRepository;
use App\Services\CustomerService;

class CustomerController extends Controller
{
    protected $customerService;
    protected $customerRepository;

    public function __construct(CustomerService $customerService, CustomerRepository $customerRepository)
    {
        $this->customerService = $customerService;
        $this->customerRepository = $customerRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $configs = config('web.config.sizes');
        // $data = $this->brandRepository->all();

        // return view('backend.brands.list', [
        //     'brands' => $data
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $data = $this->brandService->getInitData($id);
        // return view('backend.brands.form', $data);
    }

}
