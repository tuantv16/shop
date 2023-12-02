<?php

namespace App\Repositories\Interfaces;

interface ProductRepository extends BaseRepository
{

    // search Backend (manage/products)
    public function getList($params);

    // search Frontend (/shop.html)
    public function search($params);

    // Frontend
    public function getTotalProductEachCategory();
}
