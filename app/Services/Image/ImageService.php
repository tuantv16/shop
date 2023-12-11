<?php
namespace App\Services\Image;

use Illuminate\Support\Facades\Storage;

class ImageService
{
    const FOLDER_PRODUCT = 'product_images';
    public function getImageProduct($path)
    {

        $path = self::FOLDER_PRODUCT.'/'.$path;
        $storageDisk = $this->determineStorageDisk($path);
        return $storageDisk->url($path); // url image
    }

    private function determineStorageDisk($path)
    {
        if (str_starts_with($path, 'public/')) {
            return Storage::disk('public');
        }

        // Cấu hình cho S3 hoặc các đĩa khác nếu cần
        if (str_starts_with($path, 's3/')) {
            return Storage::disk('s3');
        }
     
        return Storage::disk('local');
    }
}
