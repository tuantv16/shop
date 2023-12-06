<?php

namespace App\Http\Resources\Shop;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ShopProduct extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $disk = App::environment('local') ? 'public' : 's3';
        $configs = config('web.config.uploads');
        $folderName =  $configs['products']; // đặt tên folder

        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'size_id' => $this->product_details->size_id ?? '',
            'color_id' => $this->product_details->color_id ?? '',
            'brand_id' => $this->product_details->brand_id ?? '',
            'quantity' => $this->product_details->quantity ?? '',
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'product_name' => $this->product_name,
            'description' => $this->description,
            'price' => format_vnd($this->price),
            'image' => $this->image,
            'url_image' => Storage::disk($disk)->url($folderName.'/'.$this->image),
            'slug' => '/'.Str::slug($this->product_name,'-').'-'.$this->product_code.'.html'
        ];

       
     

    }
}
