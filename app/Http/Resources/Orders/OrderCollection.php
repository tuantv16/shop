<?php

namespace App\Http\Resources\Orders;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = $this->collection->map(function($order) {
            $productNames = $order->orderDetails->map(function($orderDetail) {
                return $orderDetail->product->product_name;
            });

            $productNamesString = $productNames->implode(',');
            $order->product_names = $productNamesString;
            return $order;
        });
        
        return [
            "data" => $data,
            "currentPage" => $this->currentPage(),
            "totalPage" => $this->lastPage(),
            "totalRecords" => $this->total(),
        ];
    }
}
