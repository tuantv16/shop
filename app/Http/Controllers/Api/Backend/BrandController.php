<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Manage\FormBrandRequest;
use App\Http\Resources\Brands\Brand;
use App\Http\Resources\Categories\CategoryCollection;
use App\Repositories\Interfaces\BrandRepository;
use App\Services\BrandService;
use Illuminate\Http\Request;

class BrandController extends ApiController
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

        $data = $this->brandRepository->all();
        return $this->responseSuccess(new CategoryCollection($data));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormBrandRequest $request)
    {
        $inputDatas = $request->validated();
        $inputDatas['disp_order'] = 1;
        $data = $this->brandRepository->create($inputDatas);
        return $this->responseSuccess(new Brand($data));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FormBrandRequest $request, string $id)
    {
        $inputDatas = $request->validated();
        $data = $this->brandRepository->update($inputDatas, intval($id));
        return $this->responseSuccess(new Brand($data));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
