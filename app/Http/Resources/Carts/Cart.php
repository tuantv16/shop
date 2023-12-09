<?php

namespace App\Http\Resources\Carts;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Cart extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);
        return $data;
        // return [
        //     'id' => $this->id,
        //     'title' => $this->title,
        //     'content' => $this->content,
        //     'created_at' => $this->created_at,
        //     'updated_at' => $this->updated_at,
        // ];
    }
}
