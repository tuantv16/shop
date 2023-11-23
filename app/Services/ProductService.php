<?php

namespace App\Services;

use App\Repositories\Interfaces\ProductRepository;
use Illuminate\Support\Facades\DB;

class ProductService extends BaseService
{

    protected $productRepository;

    /**
     *
     */
    public function __construct(
        ProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;

    }

    public function getInitData($id) {
        $products = $this->productRepository->find(intval($id));

        $results = [
            'products' => $products
        ];

        return $results;
    }


}
