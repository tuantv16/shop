<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Manage\FormProductRequest;
use App\Http\Resources\Products\Product;
use App\Repositories\Interfaces\ProductRepository;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductControler extends ApiController
{

    protected $productRepository;
    protected $productService;

    public function __construct(ProductRepository $productRepository, ProductService $productService)
    {


        $this->productRepository = $productRepository;
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    //public function store(FormProductRequest $request)
    public function store(FormProductRequest $request)
    {

        $inputDatas = $request->validated();

        // Xử lý upload file, ví dụ lưu vào thư mục 'uploads'


        //$existsFileImage = $request->hasFile('image'); // true or false
        // if ($existsFileImage) {

        //     $inputDatas['fileImage'] = $request->file('image');
        //     dd($inputDatas);
        // }
            // if (app()->environment('local')) {
            //     // Môi trường local: Lưu vào Storage local
            //     $path = $file->store('uploads_tuantv'); // tự động lưu file ảnh vào thư mục uploads_tuantv, nếu chưa có thư mục này thì tự động tạo
            // } else {
            //     // Môi trường production: Lưu vào Amazon S3 hoặc dịch vụ đám mây khác
            //     $path = Storage::disk('s3')->put('s3-uploads_tuantv', $file); // Thay 's3-folder' bằng đường dẫn bạn muốn lưu file trên S3
            // }


            //$file->move($destinationPath, $filename);

            // Trả về response với thông tin file
            // return response()->json([
            //     'filename' => $filename,
            //     'path' => asset($destinationPath.'/'.$filename),
            //     'size' => $size,
            //     'extension' => $extension
            // ]);

        //$inputDatas = $request->validated();
        $data = $this->productService->saveData($inputDatas, $request);
        return $this->responseSuccess(new Product($data));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FormProductRequest $request, $id)
    {
        // $inputDatas = $request->validated();

        // $data = $this->productService->saveData($inputDatas, $request);
        // return $this->responseSuccess(new Product($data));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateProduct(FormProductRequest $request) {
        $inputDatas = $request->validated();
        $data = $this->productService->updateData($inputDatas, $request);
        return $this->responseSuccess(new Product($data));
    }

}
