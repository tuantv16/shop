<?php

namespace App\Repositories\Interfaces;

interface ProductRepository extends BaseRepository
{
    public function getList($params);
}
