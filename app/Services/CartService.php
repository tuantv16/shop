<?php

namespace App\Services;

use App\Repositories\Interfaces\CartRepository;
use Illuminate\Support\Facades\DB;

class CartService extends BaseService
{

    protected $cartRepository;

    /**
     *
     */
    public function __construct(
        CartRepository $cartRepository
    ) {
        $this->cartRepository = $cartRepository;

    }

    public function getInitData($id) {
        $carts = $this->cartRepository->find(intval($id));

        $results = [
            'carts' => $carts
        ];

        return $results;
    }


}
