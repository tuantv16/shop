<?php

namespace App\Repositories\Interfaces;

interface ProductDetailRepository extends BaseRepository
{
    public function getList($params);

    public function getListDataByProductId($productId);

}
