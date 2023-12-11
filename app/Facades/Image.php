<?php 
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Image extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'App\Services\Image\ImageService';
    }
}

