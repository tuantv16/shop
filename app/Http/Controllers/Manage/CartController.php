<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CartRepository;
use App\Services\CartService;

class CartController extends Controller
{

    protected $cartService;
    protected $cartRepository;

    public function __construct(CartService $cartService, CartRepository $cartRepository)
    {
        $this->cartService = $cartService;
        $this->cartRepository = $cartRepository;
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
