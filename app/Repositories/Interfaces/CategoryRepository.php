<?php

namespace App\Repositories\Interfaces;

interface CategoryRepository extends BaseRepository
{

    public function createCategory($category, $data);
}
