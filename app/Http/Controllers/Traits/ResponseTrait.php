<?php

namespace App\Http\Controllers\Traits;

use App\Libraries\CSVControls\CSVControl;
use App\ResponseCode\ResponseCode;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

trait ResponseTrait
{
    /**
     * @param $data
     * @param $message
     * @return JsonResponse
     */
    public function responseSuccess($data = null, $message = null): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'code' => ResponseCode::SUCCESS_CODE,
            'data' => $data,
            'message' => $message,
        ], 200);
    }


    /**
     * @param $data
     * @param $fileName
     * @return StreamedResponse
     */
    public function responseCsv($data, $fileName): StreamedResponse
    {
       
        $callback = function () use ($data) {
            $stream = fopen('php://output', 'w');
            stream_filter_prepend($stream, 'convert.iconv.utf-8/cp932//TRANSLIT');  // 文字コードをShift-JISに変換
          
            foreach ($data as $line) {
                fputcsv($stream, $line);
            }
            fclose($stream);
        };

        $header = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        return response()->stream($callback, 200, $header);
    }
}
