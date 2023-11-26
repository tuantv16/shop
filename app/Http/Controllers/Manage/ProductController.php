<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ProductRepository;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    protected $productService;
    protected $productRepository;

    public function __construct(ProductRepository $productRepository, ProductService $productService)
    {
        //dd(App::environment());
        $this->productService = $productService;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return view('backend.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->productService->getInitData();
        return view('backend.products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $data = $this->productService->getInitData();
        $data['products'] = $this->productRepository->find(intval($id));

        return view('backend.products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
