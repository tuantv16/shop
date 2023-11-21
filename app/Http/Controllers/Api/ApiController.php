<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class ApiController extends \App\Http\Controllers\Controller
{
    use ResponseTrait;

    public function responseFail($data = null, $message = null, $code = null): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'code' => $code,
            'data' => $data,
            'message' => $message,
        ], 201);
    }
}
