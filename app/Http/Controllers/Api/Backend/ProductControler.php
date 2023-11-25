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
    public function store(Request $request)
    {


        $inputDatas = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // Lấy thông tin file
            $filename = $file->getClientOriginalName(); // Tên file gốc
            $extension = $file->getClientOriginalExtension(); // Đuôi file
            $path = $file->getRealPath(); // Đường dẫn tạm thời tới file
            $size = $file->getSize(); // Kích thước file

            // Xử lý upload file, ví dụ lưu vào thư mục 'uploads'
            $destinationPath = 'image_products';

            $slug = 'hang-dep-nha';
            $extension  = request()->file('image')->getClientOriginalExtension(); //This is to get the extension of the image file just uploaded
           // $image_name = time() .'_' . $slug . '.' . $extension;

            if (app()->environment('local')) {

                try {
                    if ($request->hasFile('image')) {
                        Log::info('Starting upload to S3');
                        $file = $request->file('image');
                        $slug = time() . $file->getClientOriginalName();
                        //$filePath = 'image_products/' . $name;


                        $extension  = request()->file('image')->getClientOriginalExtension(); //This is to get the extension of the image file just uploaded
                        $image_name = time() .'_' . $slug;
                        $path = $request->file('image')->storeAs(
                            $destinationPath,
                            $image_name,
                            's3'
                        );

                        Log::info('Upload completed to S3');
                    }
                } catch (\Exception $e) {
                    Log::error('Error uploading to S3: ' . $e->getMessage());
                    // Handle the error
                }

            } else {
                $path = $file->storeAs(
                    $destinationPath, // tên thư mục chứa ảnh
                    $image_name,
                    'public' // (public hoặc s3) sử dụng lưu ảnh dưới public dưới môi trường phát triển hoặc môi trường aws (s3)
                );

            }

            dd($path);
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
        }


        //die('troi oi');


        //$inputDatas = $request->validated();
        $data = $this->productService->saveData($inputDatas);
        return $this->responseSuccess(new Product($data));
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
