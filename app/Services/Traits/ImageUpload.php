<?php

namespace App\Services\Traits;

use Illuminate\Support\Facades\Log;

trait ImageUpload
{
    /**
     * @describe resort disp order
     *
     * @param $file : thông tin file Tên file ảnh
     * @param $destinationPath : folder chứa ảnh
     * @param $$typeScreen kiểu màn hình Insert hoặc update
     * @return
     */
    public function uploads($file, $destinationPath)
    {
        $fileName = $file->getClientOriginalName(); // Tên file gốc
        // $extension = $file->getClientOriginalExtension(); // Đuôi file
        // $path = $file->getRealPath(); // Đường dẫn tạm thời tới file
        // $size = $file->getSize(); // Kích thước file

        $resultNameImage = '';
        try {
                Log::info('Starting upload image product to S3');
                $imageName = time() .'_' . $fileName;
                $diskStore = app()->environment('local') ? 'public' : 's3';
                //$diskStore = app()->environment('local') ? 's3' : 'public';

                $path = $file->storeAs(
                    $destinationPath, // tên thư mục chứa ảnh
                    $imageName,
                    $diskStore // (public hoặc s3) sử dụng lưu ảnh dưới public dưới môi trường phát triển hoặc môi trường aws (s3)
                );

                // Note: upload success -> format path = product_images/1700984258_cach-chup-hinh-san-pham-quan-ao-dep-1.jpg
                if ($path !== false) { // Trường hợp lưu ảnh thành công => return tên ảnh
                    $resultNameImage = $imageName;
                }

                Log::info('Upload completed image product to S3');
        } catch (\Exception $e) {
            Log::error('Error uploading to S3: ' . $e->getMessage());
            // Handle the error
        }

        return $resultNameImage;
    }

}
