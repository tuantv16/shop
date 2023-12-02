<?php

namespace App\Http\Resources\Shop;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopProduct extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

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
            'price' => $this->price,
            'image' => $this->image
        ];

        return parent::toArray($request);

    }
}
