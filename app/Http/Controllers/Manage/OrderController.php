<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\OrderRepository;
use App\Services\OrderService;

class OrderController extends Controller
{
    protected $orderService;
    protected $orderRepository;

    public function __construct(OrderService $orderService, OrderRepository $orderRepository)
    {
        $this->orderService = $orderService;
        $this->orderRepository = $orderRepository;
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
