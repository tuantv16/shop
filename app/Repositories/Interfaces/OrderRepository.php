<?php

namespace App\Repositories\Interfaces;

interface OrderRepository extends BaseRepository
{
    public function getDataByOrderCode($orderCode);

    public function getList($params);
    
}
