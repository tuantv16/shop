<?php

namespace App\Services;

use App\Repositories\Interfaces\BrandRepository;
use Illuminate\Support\Facades\DB;

class BrandService extends BaseService
{

    protected $brandRepository;

    /**
     *
     */
    public function __construct(
        BrandRepository $brandRepository
    ) {
        $this->brandRepository = $brandRepository;

    }

    public function getInitData($id) {
        $brands = $this->brandRepository->find(intval($id));

        $results = [
            'brands' => $brands
        ];

        return $results;
    }


}
