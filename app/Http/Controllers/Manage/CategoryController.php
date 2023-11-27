<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Http\Resources\Categories\Category;
use App\Http\Resources\Categories\CategoryCollection;
use App\Repositories\Interfaces\CategoryRepository;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $categoryService;
    protected $categoryRepository;

    public function __construct(CategoryService $categoryService, CategoryRepository $categoryRepository)
    {
        $this->categoryService = $categoryService;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $config
        //$configs = config('web.config.sizes');

        $data = $this->categoryRepository->all();

        return view('backend.categories.list', [
            'categories' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->categoryService->getInitData();
       // $data['cbCategory'] = json_decode($data['cbCategory']);
        return view('backend.categories.create', $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
