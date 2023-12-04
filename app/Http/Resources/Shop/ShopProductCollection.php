<?php

namespace App\Http\Resources\Shop;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ShopProductCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'data' => $this->collection,
            "currentPage" => $this->currentPage(),
            "totalPage" => $this->lastPage(),
            "totalRecords" => $this->total(),
        ];
    }
}
