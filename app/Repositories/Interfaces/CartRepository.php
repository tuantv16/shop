<?php

namespace App\Repositories\Interfaces;

interface CartRepository extends BaseRepository
{
    public function deleteCartByCustomerId($customerId);

    public function getCartByCustomerId($customerId);

}
