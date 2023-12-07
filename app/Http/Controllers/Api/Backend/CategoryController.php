<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Manage\CreateCategoryRequest;
use App\Http\Resources\Categories\Category;
use App\Http\Resources\Categories\CategoryCollection;
use App\Http\Resources\Categories\CategoryResource;
use App\Repositories\Interfaces\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends ApiController
{

    protected $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = $this->categoryRepository->all();
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
    public function store(CreateCategoryRequest $request)
    {
        $inputDatas = $request->validated();

        $data = $this->categoryRepository->create($inputDatas);
        Session::flash('success', 'Message lưu thông tin thành công');
        return $this->responseSuccess(new Category($data));
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
