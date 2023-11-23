<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\BrandRepository;
use App\Services\BrandService;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    protected $brandService;
    protected $brandRepository;

    public function __construct(BrandService $brandService, BrandRepository $brandRepository)
    {
        $this->brandService = $brandService;
        $this->brandRepository = $brandRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $config
        $configs = config('web.config.sizes');
        
        $data = $this->brandRepository->all();

        return view('backend.brands.list', [
            'brands' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
       // $data['cbCategory'] = json_decode($data['cbCategory']);
        return view('backend.brands.form');
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
        $data = $this->brandService->getInitData($id);
        return view('backend.brands.form', $data);
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
