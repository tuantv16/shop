<?php

namespace App\Repositories\Interfaces;

interface CustomerRepository extends BaseRepository
{
    public function register($params);

    public function login($params);
}
