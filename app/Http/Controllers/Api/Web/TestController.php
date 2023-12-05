<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class TestController extends ApiController
{

    public function test() {
        $accountSession = session()->get('account');
        dd($accountSession);
    }
}
