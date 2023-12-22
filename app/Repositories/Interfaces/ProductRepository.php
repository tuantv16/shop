<?php

namespace App\Repositories\Interfaces;

interface ProductRepository extends BaseRepository
{

    // search Backend (manage/products)
    public function getList($params);

    // Frontend
    public function getTotalProductEachCategory();

      // search shop.html (frontend)
    public function getListProducts($params);

    public function getProductByCode($productCode);

    public function getProductByIds($productIds);

    public function getProductCode($categoryId);

}
